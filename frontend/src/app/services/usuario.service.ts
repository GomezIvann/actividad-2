import { Injectable } from '@angular/core';
import { Usuario } from '../interfaces/usuario';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { API_BASE_URL } from '../common/constantes-api';
import { RespuestaAPI } from '../common/respuestas-api';

@Injectable({
  providedIn: 'root',
})
export class UsuarioService {
  url = `${API_BASE_URL}usuarios`;

  constructor(private http: HttpClient) {}

  registrarUsuario(usuario: Usuario): Observable<RespuestaAPI<Usuario>> {
    return this.http.post<RespuestaAPI<Usuario>>(this.url, usuario);
  }
  obtenerUsuarioPorDni(dni: string): Observable<RespuestaAPI<Usuario>> {
    return this.http.get<RespuestaAPI<Usuario>>(`${this.url}/${dni}`);
  }
}
