import { Component } from '@angular/core';
import { ServicioService } from '../../services/servicio.service';
import { Servicio } from '../../interfaces/servicio';
import { CommonModule } from '@angular/common';
import { Tienda } from '../../interfaces/tienda';
import { TiendaService } from '../../services/tienda.service';

@Component({
  selector: 'app-reservar-cita',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './reservar-cita.component.html',
  styleUrl: './reservar-cita.component.css',
})
export class ReservarCitaComponent {
  servicios: Servicio[] = [];
  tiendas: Tienda[] = [];
  
  constructor(private _servicioServicio: ServicioService, private _tiendaServicio: TiendaService) {}

  ngOnInit(): void {
    this._servicioServicio.obtenerServicios().subscribe((response) => {
      this.servicios = response.data;
    });
    this._tiendaServicio.obtenerTiendas().subscribe((response) => {
      this.tiendas = response.data;
    });
  }
}
