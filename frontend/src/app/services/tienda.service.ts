import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { RespuestaAPI, RespuestaAPIPaginada } from '../common/respuestas-api';
import { Tienda } from '../interfaces/tienda';
import { API_BASE_URL } from '../common/constantes-api';

@Injectable({
  providedIn: 'root',
})
export class TiendaService {
  url = `${API_BASE_URL}tiendas`;

  constructor(private http: HttpClient) {}

  obtenerTiendas(): Observable<RespuestaAPIPaginada<Tienda[]>> {
    return this.http.get<RespuestaAPIPaginada<Tienda[]>>(this.url);
  }
  obtenerTiendaPorId(id: number): Observable<RespuestaAPI<Tienda>> {
    return this.http.get<RespuestaAPI<Tienda>>(`${this.url}/${id}`);
  }
}
