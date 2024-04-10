import { Component, inject } from '@angular/core';
import { Empleado } from '../../interfaces/empleado';
import { EmpleadoService } from '../../services/empleado.service';
import { ActivatedRoute } from '@angular/router';
import { CommonModule } from '@angular/common';
import { TiendaService } from '../../services/tienda.service';
import { Tienda } from '../../interfaces/tienda';

@Component({
  selector: 'app-detalles-empleado',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './detalles-empleado.component.html',
  styleUrl: './detalles-empleado.component.css',
})
export class DetallesEmpleadoComponent {
  route: ActivatedRoute = inject(ActivatedRoute);
  empleado?: Empleado;
  tienda?: Tienda;

  constructor(
    private _servicioEmpleado: EmpleadoService,
    private _servicioTienda: TiendaService
  ) {}

  ngOnInit() {
    this.route.params.subscribe((params) => {
      const empleadoId = Number(params['id']);

      this._servicioEmpleado
        .obtenerEmpleadoPorId(empleadoId)
        .subscribe((response) => {
          this.empleado = response.data;
          this._servicioTienda
            .obtenerTiendaPorId(this.empleado.id_tienda)
            .subscribe((response) => {
              console.log(response.data);
              this.tienda = response.data;
            });
        });
    });
  }
}
