import { Component } from '@angular/core';
import { ServicioService } from '../../services/servicio.service';
import { Servicio } from '../../interfaces/servicio';
import { Tienda } from '../../interfaces/tienda';
import { TiendaService } from '../../services/tienda.service';
import {
  FormBuilder,
  FormControl,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { CommonModule } from '@angular/common';
import { MatStepperModule } from '@angular/material/stepper';
import { MatIconModule } from '@angular/material/icon';
import { STEPPER_GLOBAL_OPTIONS } from '@angular/cdk/stepper';
import { EmpleadoService } from '../../services/empleado.service';
import { Empleado } from '../../interfaces/empleado';
import { Router } from '@angular/router';
import { CitaService } from '../../services/cita.service';
import { Usuario } from '../../interfaces/usuario';
import { UsuarioService } from '../../services/usuario.service';
import { RespuestaAPI } from '../../common/respuestas-api';
import { Cita } from '../../interfaces/cita';

@Component({
  selector: 'app-reservar-cita',
  standalone: true,
  providers: [
    {
      provide: STEPPER_GLOBAL_OPTIONS,
      useValue: { displayDefaultIndicatorType: false },
    },
  ],
  imports: [CommonModule, ReactiveFormsModule, MatStepperModule, MatIconModule],
  templateUrl: './reservar-cita.component.html',
  styleUrl: './reservar-cita.component.css',
})
export class ReservarCitaComponent {
  servicios: Servicio[] = [];
  empleados: Empleado[] = [];
  empleadosDisponibles: Empleado[] = [];
  tiendas: Tienda[] = [];
  horariosDisponibles: string[] = [];
  usuarioExistente: boolean = false;
  usuarioActualId: number = -1;

  reservarCitaForm = this._formBuilder.group({
    formArray: this._formBuilder.array([
      this._formBuilder.group({
        dni: ['', [Validators.required, Validators.pattern(/^[0-9]{8}[A-Z]$/)]],
        nombre: ['', Validators.required],
        apellidos: ['', [Validators.required, Validators.minLength(8)]],
        email: ['', [Validators.required, Validators.email]],
        telefono: [
          '',
          [
            Validators.minLength(9),
            Validators.maxLength(9),
            Validators.pattern(/^[0-9]+$/),
          ],
        ],
        direccion: ['', Validators.required],
        ciudad: ['', Validators.required],
        pais: ['', Validators.required],
      }),
      this._formBuilder.group({
        servicio: ['', Validators.required],
        fecha: ['', [Validators.required, this.esFechaPosteriorValidator()]],
        horario: [{ value: '', disabled: true }, Validators.required],
      }),
      this._formBuilder.group({
        tienda: ['', Validators.required],
        empleado: [{ value: '', disabled: true }, Validators.required],
      }),
    ]),
  });

  constructor(
    private _citaServicio: CitaService,
    private _empleadoServicio: EmpleadoService,
    private _servicioServicio: ServicioService,
    private _usuarioServicio: UsuarioService,
    private _tiendaServicio: TiendaService,
    private _formBuilder: FormBuilder,
    private _router: Router
  ) {}

  ngOnInit(): void {
    this._servicioServicio.obtenerServicios().subscribe((respuesta) => {
      this.servicios = respuesta.data.data;
    });
    this._empleadoServicio.obtenerEmpleados().subscribe((respuesta) => {
      this.empleados = respuesta.data.data;
    });
    this._tiendaServicio.obtenerTiendas().subscribe((respuesta) => {
      this.tiendas = respuesta.data.data;
    });

    this.dni.valueChanges.subscribe(() => {
      this._usuarioServicio
        .obtenerUsuarioPorDni(this.dni.value)
        .subscribe((respuesta) => {
          this.consultarUsuarioActualPorDni(respuesta);
        });
    });
    this.fecha.valueChanges.subscribe(() => {
      if (this.fecha.value && this.fecha.valid) {
        this.horario.enable();
        this.generarHorariosDisponibles(this.fecha.value);
      }
      if (this.fecha.value && this.fecha.invalid) {
        this.horario.disable();
        this.horario.setValue('');
      }
    });
    this.tienda.valueChanges.subscribe(() => {
      this.obtenerEmpleadosTienda();
      this.empleado.enable();
    });
  }

  get formArray() {
    return this.reservarCitaForm.get('formArray') as any;
  }

  get nombre() {
    return this.formArray.at(0).get('nombre');
  }

  get apellidos() {
    return this.formArray.at(0).get('apellidos');
  }

  get dni() {
    return this.formArray.at(0).get('dni');
  }

  get email() {
    return this.formArray.at(0).get('email');
  }

  get telefono() {
    return this.formArray.at(0).get('telefono');
  }

  get direccion() {
    return this.formArray.at(0).get('direccion');
  }

  get ciudad() {
    return this.formArray.at(0).get('ciudad');
  }

  get pais() {
    return this.formArray.at(0).get('pais');
  }

  get servicio() {
    return this.formArray.at(1).get('servicio');
  }

  get fecha() {
    return this.formArray.at(1).get('fecha');
  }

  get horario() {
    return this.formArray.at(1).get('horario');
  }

  get empleado() {
    return this.formArray.at(2).get('empleado');
  }

  get tienda() {
    return this.formArray.at(2).get('tienda');
  }

  /**
   * Comprueba si la fecha seleccionada es posterior a la actual.
   * @returns
   */
  esFechaPosteriorValidator(): any {
    return (control: FormControl) => {
      const selectedDate = new Date(control.value);
      const currentDate = new Date();
      currentDate.setHours(0, 0, 0, 0);
      return currentDate >= selectedDate ? { fechaAnterior: true } : null;
    };
  }

  /**
   * Genera los horarios disponibles para la fecha seleccionada
   * Si la fecha seleccionada es la actual, se generan los horarios a partir de la hora actual.
   * Si la fecha seleccionada es distinta a la actual, se generan los horarios a partir de las 9:00 hasta las 20:00.
   * @param fecha
   */
  private generarHorariosDisponibles(fechaSeleccionada: string): void {
    const fechaActual = new Date().toISOString().split('T')[0];
    this.horariosDisponibles = [];
    if (fechaSeleccionada === fechaActual) {
      const horaActual = new Date().getHours() + 1;
      for (let i = horaActual; i <= 20; i++) {
        const hora = `${i.toString().padStart(2, '0')}:00`;
        this.horariosDisponibles.push(hora);
      }
    } else {
      for (let i = 9; i <= 20; i++) {
        const hora = `${i.toString().padStart(2, '0')}:00`;
        this.horariosDisponibles.push(hora);
      }
    }
  }

  /**
   * Consulta si el usuario actual ha reservado previamente con nosotros y rellena los campos automáticamente
   * @param respuesta
   */
  private consultarUsuarioActualPorDni(respuesta: RespuestaAPI<Usuario>): void {
    if (
      respuesta.message === 'Success' &&
      confirm(
        'Ya has reservado previamente con nosotros, ¿deseas rellenar los campos automáticamente con la información de tu última reserva?'
      )
    ) {
      this.nombre.setValue(respuesta.data.nombre);
      this.apellidos.setValue(respuesta.data.apellido);
      this.email.setValue(respuesta.data.correo);
      this.telefono.setValue(respuesta.data.telefono);
      this.direccion.setValue(respuesta.data.direccion);
      this.ciudad.setValue(respuesta.data.ciudad);
      this.pais.setValue(respuesta.data.pais);
      this.usuarioActualId = respuesta.data.id;
      this.usuarioExistente = true;
    }
  }

  /**
   * Obtiene los empleados disponibles para la fecha y hora seleccionada.
   */
  private obtenerEmpleadosDisponibles() {
    this.empleados = this.empleados.filter((empleado) => {
      this._citaServicio
        .obtenerCitasEmpleado(empleado.id)
        .subscribe((respuesta) => {
          const citasEmpleado = respuesta.data.data;

          citasEmpleado.forEach((cita) => {
            if (
              cita.fecha === this.fecha.value &&
              cita.hora === this.horario.value
            ) {
              this.empleados = this.empleados.filter(
                (empleado) => empleado.id !== cita.id_empleado
              );
            }
          });
        });
    });
  }

  /**
   * Obtiene los empleados de la tienda seleccionada.
   */
  private obtenerEmpleadosTienda() {
    this.empleadosDisponibles = this.empleados.filter(
      (empleado) => empleado.id_tienda == this.tienda.value
    );
  }

  reservarCita(): void {
    const textoConfirmacion = 'Vas a reservar la cita, ¿estás seguro?';
    if (confirm(textoConfirmacion)) {
      this.gestionarUsuarioFormulario();
      const cita: Cita = {
        id_usuario: this.usuarioActualId,
        id_empleado: this.empleado.value,
        id_tienda: this.tienda.value,
        fecha: this.fecha.value,
        hora: this.horario.value,
      };
      this._citaServicio.reservarCita(cita);
      this._router.navigate(['/cita-confirmada']);
    }
  }

  private gestionarUsuarioFormulario(): void {
    const usuario: Usuario = {
      nombre: this.nombre.value,
      apellido: this.apellidos.value,
      dni: this.dni.value,
      correo: this.email.value,
      telefono: this.telefono.value,
      direccion: this.direccion.value,
      ciudad: this.ciudad.value,
      pais: this.pais.value,
    };
    if (this.usuarioExistente)
      this._usuarioServicio.actualizarUsuario(this.usuarioActualId, usuario);
    else
      this.usuarioActualId =
        this._usuarioServicio.registrarUsuario(usuario).data.id;
  }
}
