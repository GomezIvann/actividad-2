import { Component } from '@angular/core';
import { ServicioService } from '../../services/servicio.service';
import { Servicio } from '../../interfaces/servicio';
import { Tienda } from '../../interfaces/tienda';
import { TiendaService } from '../../services/tienda.service';
import { FormBuilder, ReactiveFormsModule, Validators } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { MatStepperModule } from '@angular/material/stepper';
import { MatIconModule } from '@angular/material/icon';
import { STEPPER_GLOBAL_OPTIONS } from '@angular/cdk/stepper';
import { EmpleadoService } from '../../services/empleado.service';
import { Empleado } from '../../interfaces/empleado';
import { Router } from '@angular/router';
import { CitaService } from '../../services/cita.service';
import { Cita } from '../../interfaces/cita';
import { Usuario } from '../../interfaces/usuario';
import { UsuarioService } from '../../services/usuario.service';

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
  tiendas: Tienda[] = [];

  horariosDisponibles: string[] = [];

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
        fecha: ['', Validators.required],
        horario: [{ value: '', disabled: true }, Validators.required],
      }),
      this._formBuilder.group({
        empleado: [''],
        tienda: [''],
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
          if (
            respuesta.message === 'success' &&
            confirm(
              'Ya has reservado previamente con nosotros, ¿deseas rellenar los campos automáticamente con la información de tu última reserva?'
            )
          ) {
            this.nombre.setValue(respuesta.data.nombre);
            this.apellidos.setValue(respuesta.data.apellidos);
            this.email.setValue(respuesta.data.correo);
            this.telefono.setValue(respuesta.data.telefono);
            this.direccion.setValue(respuesta.data.direccion);
            this.ciudad.setValue(respuesta.data.ciudad);
            this.pais.setValue(respuesta.data.pais);
          }
        });
    });

    this.fecha.valueChanges.subscribe(() => {
      if (this.formArray.at(1).get('fecha').value) {
        this.formArray.at(1).get('horario').enable();
        this.generarHorariosDisponibles(
          this.formArray.at(1).get('fecha').value
        );
      }
    });
    this.servicio.valueChanges.subscribe(() => {
      if (this.formArray.at(1).get('servicio').value)
        this.formArray.at(1).get('empleado').enable();
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
   * Genera los horarios disponibles para la fecha seleccionada
   * Si la fecha seleccionada es la actual, se generan los horarios a partir de la hora actual.
   * Si la fecha seleccionada es distinta a la actual, se generan los horarios a partir de las 9:00 hasta las 20:00.
   * @param fecha
   */
  generarHorariosDisponibles(fechaSeleccionada: string): void {
    const fechaActual = new Date().toISOString().split('T')[0];
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

  reservarCita(): void {
    const textoConfirmacion = 'Vas a reservar la cita, ¿estás seguro?';
    if (confirm(textoConfirmacion) == true) {
      const usuario: Usuario = {
        dni: this.dni.value,
        nombre: this.nombre.value,
        apellidos: this.apellidos.value,
        direccion: this.direccion.value,
        ciudad: this.ciudad.value,
        pais: this.pais.value,
        correo: this.email.value,
        telefono: this.telefono.value,
      };
      // const cita: Cita = {
      //   id_usuario: usuario.id,
      //   id_empleado: this.empleado.value,
      //   id_tienda: this.tienda.value,
      //   fecha: this.fecha.value,
      //   hora: this.horario.value,
      //   dni: usuario.dni,
      // };
      this._usuarioServicio.registrarUsuario(usuario);
      // this._citaServicio.reservarCita(cita);

      // TODO: Redirigir a la página de confirmación de cita SOLO si la petición se ha realizado correctamente
      // this._router.navigate(['/cita-confirmada']);
    }
  }
}
