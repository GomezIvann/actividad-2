import { Component, Input } from '@angular/core';
import { Tienda } from '../../interfaces/tienda';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-tarjeta-tienda',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './tarjeta-tienda.component.html',
  styleUrl: './tarjeta-tienda.component.css',
})
export class TarjetaTiendaComponent {
  @Input() tienda!: Tienda;
}
