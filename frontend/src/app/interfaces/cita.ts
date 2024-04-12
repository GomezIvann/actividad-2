import { Empleado } from './empleado';
import { Servicio } from './servicio';
import { Tienda } from './tienda';

export class Cita {
  id?: number;
  id_usuario: number;
  id_empleado: number;
  id_tienda: number;
  fecha: string;
  hora: string;

  servicios?: Servicio[];
  empleado?: Empleado;
  tienda?: Tienda;

  constructor(
    id_usuario: number,
    id_empleado: number,
    id_tienda: number,
    fecha: string,
    hora: string,
    servicios?: Servicio[],
    empleado?: Empleado,
    tienda?: Tienda
  ) {
    this.id_usuario = id_usuario;
    this.id_empleado = id_empleado;
    this.id_tienda = id_tienda;
    this.fecha = fecha;
    this.hora = hora;
    this.servicios = servicios;
    this.empleado = empleado;
    this.tienda = tienda;
  }

  obtenerPrecioTotal(): number {
    return this.servicios
      ? this.servicios.reduce((total, servicio) => total + servicio.precio, 0)
      : 0;
  }
}
