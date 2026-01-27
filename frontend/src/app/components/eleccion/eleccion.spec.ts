import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Eleccion } from './eleccion';

describe('Eleccion', () => {
  let component: Eleccion;
  let fixture: ComponentFixture<Eleccion>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [Eleccion]
    })
    .compileComponents();

    fixture = TestBed.createComponent(Eleccion);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
