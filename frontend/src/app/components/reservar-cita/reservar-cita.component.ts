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

  reservarCitaForm = this._formBuilder.group({
    formArray: this._formBuilder.array([
      this._formBuilder.group({
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
    private _servicioServicio: ServicioService,
    private _empleadoServicio: EmpleadoService,
    private _tiendaServicio: TiendaService,
    private _formBuilder: FormBuilder,
    private _router: Router
  ) {}

  ngOnInit(): void {
    this._servicioServicio.obtenerServicios().subscribe((response) => {
      this.servicios = response.data;
    });
    this._empleadoServicio.obtenerEmpleados().subscribe((response) => {
      this.empleados = response.data;
    });
    this._tiendaServicio.obtenerTiendas().subscribe((response) => {
      this.tiendas = response.data;
    });

    this.fecha.valueChanges.subscribe(() => {
      if (this.formArray.at(1).get('fecha').value)
        this.formArray.at(1).get('horario').enable();
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

  get email() {
    return this.formArray.at(0).get('email');
  }

  get telefono() {
    return this.formArray.at(0).get('telefono');
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

  reservarCita(): void {
    let text = 'Vas a reservar la cita, ¿estás seguro?';
    if (confirm(text) == true) {
      // console.warn(this.reservarCitaForm.value);
      this._router.navigate(['/cita-confirmada']);
    }
  }
}
