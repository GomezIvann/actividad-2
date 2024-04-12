import { Component, LOCALE_ID } from '@angular/core';
import { CitaService } from '../../services/cita.service';
import { Cita } from '../../interfaces/cita';
import { CommonModule, registerLocaleData, TitleCasePipe } from '@angular/common';
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
  citas: Cita[] = [
    new Cita(
      1,
      1,
      1,
      '2024-06-01',
      '10:00',
      [
        {
          id: 1,
          codigo: 1,
          nombre: 'Corte de pelo',
          descripcion: 'Corte de pelo y peinado',
          precio: 10,
        },
        {
          id: 1,
          codigo: 1,
          nombre: 'Manicura',
          descripcion: 'Tratamientos de uñas',
          precio: 10,
        },
      ],
      {
        id: 1,
        id_tienda: 1,
        nombre: 'Juan',
        apellidos: 'Pérez',
        ciudad: 'Madrid',
        pais: 'España',
        imagen: 'imagen.jpg',
        red_social: 'instagram.com/juanperez',
      },
      {
        id: 1,
        direccion: 'Calle Falsa 123',
        horario: '10:00 - 20:00',
        telefono: '123456789',
        capacidad: 10,
        estado: 'abierta',
        imagen: 'imagen.jpg',
      },
    ),
  ];
  dni: string = '87654321B';

  constructor(
    private _citaServicio: CitaService,
    private _empleadoServicio: EmpleadoService,
    private _servicioServicio: ServicioService,
    private _tiendaServicio: TiendaService,
  ) {}

  consultarCitas() {
    this._citaServicio.obtenerCitasUsuario(this.dni).subscribe((respuesta) => {
      this.citas = respuesta.data;

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

        // servicios de la cita
      });
    });
  }
}
