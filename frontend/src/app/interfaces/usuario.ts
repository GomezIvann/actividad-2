export interface Usuario {
  id?: number;
  dni: string;
  nombre: string;
  apellidos: string;
  direccion: string;
  ciudad: string;
  pais: string;
  correo: string;
  telefono?: number;
}
