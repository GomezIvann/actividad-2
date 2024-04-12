import { Component, inject } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { TiendaService } from '../../services/tienda.service';
import { Tienda } from '../../interfaces/tienda';
import { CommonModule, TitleCasePipe } from '@angular/common';

@Component({
  selector: 'app-detalles-tienda',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './detalles-tienda.component.html',
  styleUrl: './detalles-tienda.component.css',
})
export class DetallesTiendaComponent {
  route: ActivatedRoute = inject(ActivatedRoute);
  tienda: Tienda | undefined;

  constructor(private _servicioTienda: TiendaService) {}

  ngOnInit() {
    this.route.params.subscribe((params) => {
      const tiendaId = Number(params['id']);
      this._servicioTienda
        .obtenerTiendaPorId(tiendaId)
        .subscribe((respuesta) => {
          this.tienda = respuesta.data;
        });
    });
  }
}
