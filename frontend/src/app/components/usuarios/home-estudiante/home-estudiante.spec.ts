import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HomeEstudiante } from './home-estudiante';

describe('HomeEstudiante', () => {
  let component: HomeEstudiante;
  let fixture: ComponentFixture<HomeEstudiante>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [HomeEstudiante]
    })
    .compileComponents();

    fixture = TestBed.createComponent(HomeEstudiante);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
