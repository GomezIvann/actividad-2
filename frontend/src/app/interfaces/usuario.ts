export interface Usuario {
  dni: string;
  nombre: string;
  apellidos: string;
  genero?: 'Hombre' | 'Mujer' | 'Otro';
  direccion: string;
  ciudad: string;
  pais: string;
  correo: string;
  telefono?: number;
}
