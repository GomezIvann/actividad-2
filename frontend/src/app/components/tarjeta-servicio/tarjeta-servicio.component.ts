import { Component, Input } from '@angular/core';
import { Servicio } from '../../interfaces/servicio';

@Component({
  selector: 'app-tarjeta-servicio',
  standalone: true,
  imports: [],
  templateUrl: './tarjeta-servicio.component.html',
  styleUrl: './tarjeta-servicio.component.css',
})
export class TarjetaServicioComponent {
  @Input() servicio!: Servicio;
}
