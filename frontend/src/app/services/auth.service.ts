import { Injectable } from '@angular/core';
import { Usuario } from '../interfaces/usuario';
import { Servicio } from '../interfaces/servicio';
import { Cita } from '../interfaces/cita';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  cita: Cita;
  usuario: Usuario;
  usuarioActualId: Usuario['id'];
  existeUsuario: boolean;
  idsServicios: Servicio['id'][];

  constructor() {}

  guardarDatosFormulario(
    cita: Cita,
    usuario: Usuario,
    usuarioActualId: Usuario['id'],
    existeUsuario: boolean,
    idsServicios: Servicio['id'][]
  ) {
    this.cita = cita;
    this.usuario = usuario;
    this.usuarioActualId = usuarioActualId;
    this.existeUsuario = existeUsuario;
    this.idsServicios = idsServicios;
  }

  obtenerDatosFormulario() {
    return {
      cita: this.cita,
      usuario: this.usuario,
      usuarioActualId: this.usuarioActualId,
      existeUsuario: this.existeUsuario,
      idsServicios: this.idsServicios,
    };
  }
}
