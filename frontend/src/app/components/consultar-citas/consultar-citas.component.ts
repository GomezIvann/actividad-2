import { Component, LOCALE_ID } from '@angular/core';
import { CitaService } from '../../services/cita.service';
import { Cita } from '../../interfaces/cita';
import {
  CommonModule,
  registerLocaleData,
  TitleCasePipe,
} from '@angular/common';
import { FormsModule } from '@angular/forms';
import { EmpleadoService } from '../../services/empleado.service';
import { ServicioService } from '../../services/servicio.service';
import { TiendaService } from '../../services/tienda.service';
import { RouterLink } from '@angular/router';
import localeEs from '@angular/common/locales/es';

registerLocaleData(localeEs);

@Component({
  selector: 'app-consultar-citas',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterLink],
  templateUrl: './consultar-citas.component.html',
  styleUrl: './consultar-citas.component.css',
  providers: [{ provide: LOCALE_ID, useValue: 'es' }],
})
export class ConsultarCitasComponent {
  citas: Cita[] = [];
  dni: string = '';

  constructor(
    private _citaServicio: CitaService,
    private _empleadoServicio: EmpleadoService,
    private _servicioServicio: ServicioService,
    private _tiendaServicio: TiendaService
  ) {}

  consultarCitas() {
    this._citaServicio.obtenerCitasUsuario(this.dni).subscribe((respuesta) => {
      this.citas = respuesta.data.data;

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
    });
  }
  obtenerPrecioTotal(cita: Cita): number {
    return cita.servicios.reduce(
      (total, servicio) => total + servicio.precio,
      0
    );
  }
}
