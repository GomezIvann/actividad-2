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
import { NumberValidator } from '../../common/NumberValidator';

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
  tiendas: Tienda[] = [];

  reservarCitaForm = this._formBuilder.group({
    formArray: this._formBuilder.array([
      this._formBuilder.group({
        nombre: ['', Validators.required],
        apellidos: ['', [Validators.required, Validators.minLength(8)]],
        email: ['', Validators.email],
        telefono: [
          '',
          [Validators.minLength(9), Validators.maxLength(9), NumberValidator()],
        ],
      }),
      this._formBuilder.group({
        servicio: ['', Validators.required],
        empleado: [{ value: '', disabled: true }, Validators.required],
      }),
      this._formBuilder.group({
        fecha: ['', Validators.required],
        tienda: ['', Validators.required],
        horario: [{ value: '', disabled: true }, Validators.required],
      }),
    ]),
  });

  constructor(
    private _servicioServicio: ServicioService,
    private _tiendaServicio: TiendaService,
    private _formBuilder: FormBuilder
  ) {}

  ngOnInit(): void {
    this._servicioServicio.obtenerServicios().subscribe((response) => {
      this.servicios = response.data;
    });
    this._tiendaServicio.obtenerTiendas().subscribe((response) => {
      this.tiendas = response.data;
    });

    this.formArray
      .at(1)
      .get('servicio')
      .valueChanges.subscribe(() => {
        if (this.formArray.at(1).get('servicio').value)
          this.formArray.at(1).get('empleado').enable();
      });
  }

  get formArray() {
    return this.reservarCitaForm.get('formArray') as any;
  }

  reservarCita(): void {
    console.warn(this.reservarCitaForm.value);
  }
}
