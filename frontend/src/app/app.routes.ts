import { Routes } from '@angular/router';
import { InicioComponent } from './components/inicio/inicio.component';
import { TiendasComponent } from './components/tiendas/tiendas.component';
import { ContactoComponent } from './components/contacto/contacto.component';
import { DetallesTiendaComponent } from './components/detalles-tienda/detalles-tienda.component';
import { ServiciosComponent } from './components/servicios/servicios.component';
import { ReservarCitaComponent } from './components/reservar-cita/reservar-cita.component';
import { EmpleadosComponent } from './components/empleados/empleados.component';
import { CitaConfirmadaComponent } from './components/cita-confirmada/cita-confirmada.component';
import { authGuard } from './guards/auth.guard';
import { DetallesEmpleadoComponent } from './components/detalles-empleado/detalles-empleado.component';

export const routes: Routes = [
  {
    path: '',
    component: InicioComponent,
    title: 'Inicio',
  },
  {
    path: 'inicio',
    component: InicioComponent,
    title: 'Inicio',
  },
  {
    path: 'servicios',
    component: ServiciosComponent,
    title: 'Servicios',
  },
  {
    path: 'tiendas',
    component: TiendasComponent,
    title: 'Tiendas',
  },
  {
    path: 'contacto',
    component: ContactoComponent,
    title: 'Contacto',
  },
  {
    path: 'detalles-tienda/:id',
    component: DetallesTiendaComponent,
    title: 'Detalles de la tienda',
  },
  {
    path: 'detalles-empleado/:id',
    component: DetallesEmpleadoComponent,
    title: 'Detalles del empleado',
  },
  {
    path: 'reservar-cita',
    component: ReservarCitaComponent,
    title: 'Reserva tu cita',
  },
  {
    path: 'empleados',
    component: EmpleadosComponent,
    title: 'Empleados',
  },
  {
    path: 'cita-confirmada',
    component: CitaConfirmadaComponent,
    title: 'Cita confirmada',
    canActivate: [authGuard],
  },
  {
    path: '**',
    redirectTo: 'inicio',
  },
];
