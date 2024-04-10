import { Component } from '@angular/core';
import { Servicio } from '../../interfaces/servicio';
import { ServicioService } from '../../services/servicio.service';
import { CommonModule } from '@angular/common';
import { TarjetaServicioComponent } from '../tarjeta-servicio/tarjeta-servicio.component';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-servicios',
  standalone: true,
  imports: [CommonModule, RouterLink, TarjetaServicioComponent],
  templateUrl: './servicios.component.html',
  styleUrl: './servicios.component.css',
})
export class ServiciosComponent {
  servicios: Servicio[] = [];

  constructor(private _servicioServicio: ServicioService) {}

  ngOnInit(): void {
    this._servicioServicio.obtenerServicios().subscribe((response) => {
      this.servicios = response.data.data;
    });
  }
}
