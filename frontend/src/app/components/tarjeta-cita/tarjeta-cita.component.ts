import { Component, Input } from '@angular/core';
import { Cita } from '../../interfaces/cita';
import { RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-tarjeta-cita',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './tarjeta-cita.component.html',
  styleUrl: './tarjeta-cita.component.css',
})
export class TarjetaCitaComponent {
  @Input() cita: Cita;
  coste: number = 0;

  constructor() {}

  ngOnInit(): void {
    this.coste = this.cita.servicios.reduce(
      (total, servicio) => total + servicio.precio,
      0
    );
  }
}
