import { Component, inject } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { TiendaService } from '../../services/tienda.service';
import { Tienda } from '../../interfaces/tienda';
import { TitleCasePipe } from '@angular/common';

@Component({
  selector: 'app-detalles-tienda',
  standalone: true,
  imports: [TitleCasePipe],
  templateUrl: './detalles-tienda.component.html',
  styleUrl: './detalles-tienda.component.css',
})
export class DetallesTiendaComponent {
  route: ActivatedRoute = inject(ActivatedRoute);
  servicioTienda: TiendaService = inject(TiendaService);
  tienda: Tienda | undefined;

  constructor() {
    const tiendaId = Number(this.route.snapshot.params['id']);
    this.tienda = this.servicioTienda.obtenerTiendaPorId(tiendaId);
  }
}
