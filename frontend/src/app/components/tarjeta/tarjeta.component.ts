import { Component, Input } from '@angular/core';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-tarjeta',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './tarjeta.component.html',
  styleUrl: './tarjeta.component.css',
})
export class TarjetaComponent {
  @Input() id!: number;
  @Input() imagen!: string;
  @Input() ruta!: string;
  @Input() titulo!: string;
}
