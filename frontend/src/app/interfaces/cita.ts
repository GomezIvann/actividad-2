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
}
