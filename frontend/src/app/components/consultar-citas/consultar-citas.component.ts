import { Component, LOCALE_ID } from '@angular/core';
import { CitaService } from '../../services/cita.service';
import { Cita } from '../../interfaces/cita';
import { CommonModule, registerLocaleData } from '@angular/common';
import {
  FormControl,
  FormsModule,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { EmpleadoService } from '../../services/empleado.service';
import { TiendaService } from '../../services/tienda.service';
import { RouterLink } from '@angular/router';
import localeEs from '@angular/common/locales/es';
import { TarjetaCitaComponent } from '../tarjeta-cita/tarjeta-cita.component';

registerLocaleData(localeEs);

@Component({
  selector: 'app-consultar-citas',
  standalone: true,
  imports: [
    CommonModule,
    FormsModule,
    RouterLink,
    TarjetaCitaComponent,
    ReactiveFormsModule,
  ],
  templateUrl: './consultar-citas.component.html',
  styleUrl: './consultar-citas.component.css',
  providers: [{ provide: LOCALE_ID, useValue: 'es' }],
})
export class ConsultarCitasComponent {
  citas: Cita[] = [];
  dni = new FormControl('', [Validators.pattern(/^[0-9]{8}[A-Z]$/)]);
  sinCitas: boolean = false;

  constructor(
    private _citaServicio: CitaService,
    private _empleadoServicio: EmpleadoService,
    private _tiendaServicio: TiendaService
  ) {}

  consultarCitas() {
    this._citaServicio
      .obtenerCitasUsuario(this.dni.value)
      .subscribe((respuesta) => {
        this.citas = respuesta.data.data;

        if (respuesta.message !== 'Success') this.sinCitas = true;
        else {
          this.citas.forEach((cita) => {
            this._empleadoServicio
              .obtenerEmpleadoPorId(cita.id_empleado)
              .subscribe((respuesta) => {
                cita.empleado = respuesta.data;
              });
            this._tiendaServicio
              .obtenerTiendaPorId(cita.id_tienda)
              .subscribe((respuesta) => {
                cita.tienda = respuesta.data;
              });
            this._citaServicio
              .obtenerServiciosCita(cita?.id)
              .subscribe((respuesta) => {
                cita.servicios = respuesta.data;
              });
          });
        }
      });
  }
}
