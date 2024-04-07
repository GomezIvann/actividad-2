import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TarjetaInicioComponent } from './tarjeta-inicio.component';

describe('TarjetaInicioComponent', () => {
  let component: TarjetaInicioComponent;
  let fixture: ComponentFixture<TarjetaInicioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [TarjetaInicioComponent],
    }).compileComponents();

    fixture = TestBed.createComponent(TarjetaInicioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
