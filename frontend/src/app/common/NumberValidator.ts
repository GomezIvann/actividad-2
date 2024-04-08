import { AbstractControl, ValidatorFn } from '@angular/forms';

/**
 *
 * @returns {ValidatorFn} - Validador personalizado para aceptar solo números
 */
export function NumberValidator(): ValidatorFn {
  return (control: AbstractControl): { [key: string]: any } | null => {
    const value = control.value;

    if (value === null || value === undefined || value === '') return null;

    const regex = /^[0-9]+$/;
    if (!regex.test(value)) return { number: true };
    return null;
  };
}
