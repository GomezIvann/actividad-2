import { Component, inject } from '@angular/core';
import { Servicio } from '../../interfaces/servicio';
import { ServicioService } from '../../services/servicio.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-servicios',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './servicios.component.html',
  styleUrl: './servicios.component.css',
})
export class ServiciosComponent {
  servicios: Servicio[] = [];
  servicioServicio: ServicioService = inject(ServicioService);

  constructor() {
    this.servicios = this.servicioServicio.obtenerServicios();
  }
}