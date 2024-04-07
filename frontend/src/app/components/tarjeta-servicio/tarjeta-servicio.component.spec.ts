import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TarjetaServicioComponent } from './tarjeta-servicio.component';

describe('TarjetaServicioComponent', () => {
  let component: TarjetaServicioComponent;
  let fixture: ComponentFixture<TarjetaServicioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [TarjetaServicioComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(TarjetaServicioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
