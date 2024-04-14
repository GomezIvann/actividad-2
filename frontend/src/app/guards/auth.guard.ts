import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { CitaService } from '../services/cita.service';
import { UsuarioService } from '../services/usuario.service';

export const authGuard: CanActivateFn = (route, state) => {
  const authService = inject(AuthService);
  const citaServicio = inject(CitaService);
  const usuarioServicio = inject(UsuarioService);
  const router = inject(Router);

  const datosFormulario = authService.obtenerDatosFormulario();
  if (!datosFormulario.cita || !datosFormulario.usuario) {
    router.navigate(['/']);
    return false;
  } else {
    // Registrar o actualizar usuario
    const { cita, usuario, existeUsuario, idsServicios } = datosFormulario;
    let { usuarioActualId } = datosFormulario;

    if (existeUsuario && usuarioActualId !== -1)
      usuarioServicio.actualizarUsuario(usuarioActualId, usuario);
    else usuarioActualId = usuarioServicio.registrarUsuario(usuario).id;

    // Reservar cita
    return citaServicio.reservarCita(cita, idsServicios);
  }
};
