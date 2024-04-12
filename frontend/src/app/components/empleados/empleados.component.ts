import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TarjetaComponent } from '../tarjeta/tarjeta.component';
import { EmpleadoService } from '../../services/empleado.service';
import { Empleado } from '../../interfaces/empleado';

@Component({
  selector: 'app-empleados',
  standalone: true,
  imports: [CommonModule, TarjetaComponent],
  templateUrl: './empleados.component.html',
  styleUrl: './empleados.component.css',
})
export class EmpleadosComponent {
  empleados: Empleado[] = [];

  constructor(private _servicioEmpleado: EmpleadoService) {}

  ngOnInit(): void {
    this._servicioEmpleado.obtenerEmpleados().subscribe((respuesta) => {
      this.empleados = respuesta.data.data;
    });
  }
}
