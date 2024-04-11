import { Injectable } from '@angular/core';
import { API_BASE_URL } from '../common/constantes-api';
import { HttpClient } from '@angular/common/http';
import { RespuestaAPI } from '../common/respuestas-api';
import { Cita } from '../interfaces/cita';

@Injectable({
  providedIn: 'root',
})
export class CitaService {
  url = `${API_BASE_URL}citas`;

  constructor(private http: HttpClient) {}

  obtenerCitasUsuario(dni: string) {
    return this.http.get<RespuestaAPI<Cita>>(`${this.url}/${dni}`);
  }
  reservarCita(cita: Cita) {
    return this.http.post<RespuestaAPI<Cita>>(this.url, cita);
  }
}
