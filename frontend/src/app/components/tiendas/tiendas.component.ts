import { Component, inject } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TiendaService } from '../../services/tienda.service';
import { Tienda } from '../../interfaces/tienda';
import { TarjetaTiendaComponent } from '../tarjeta-tienda/tarjeta-tienda.component';

@Component({
  selector: 'app-tiendas',
  standalone: true,
  imports: [CommonModule, TarjetaTiendaComponent],
  templateUrl: './tiendas.component.html',
  styleUrl: './tiendas.component.css',
})
export class TiendasComponent {
  tiendas: Tienda[] = [];
  servicioTienda: TiendaService = inject(TiendaService);

  constructor() {
    this.tiendas = this.servicioTienda.obtenerTiendas();
  }
}
