import { Component, Input } from '@angular/core';
import { Tienda } from '../../interfaces/tienda';

@Component({
  selector: 'app-tarjeta-tienda',
  standalone: true,
  imports: [],
  templateUrl: './tarjeta-tienda.component.html',
  styleUrl: './tarjeta-tienda.component.css'
})
export class TarjetaTiendaComponent {
  @Input() tienda!: Tienda;
}
