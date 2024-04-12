import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TiendaService } from '../../services/tienda.service';
import { Tienda } from '../../interfaces/tienda';
import { TarjetaComponent } from '../tarjeta/tarjeta.component';

@Component({
  selector: 'app-tiendas',
  standalone: true,
  imports: [CommonModule, TarjetaComponent],
  templateUrl: './tiendas.component.html',
  styleUrl: './tiendas.component.css',
})
export class TiendasComponent {
  tiendas: Tienda[] = [];

  constructor(private _servicioTienda: TiendaService) {}

  ngOnInit(): void {
    this._servicioTienda.obtenerTiendas().subscribe((respuesta) => {
      this.tiendas = respuesta.data.data;
    });
  }
}
