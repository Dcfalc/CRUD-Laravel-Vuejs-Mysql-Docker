import { required, email, min, max, regex } from "vee-validate/dist/rules";
import { extend } from "vee-validate";
import { setInteractionMode } from 'vee-validate';

setInteractionMode('lazy');

extend("regex", {
    ...regex,
    message: 'Informe um número válido'
  });

extend("required", {
  ...required,
  message: "Este campo é necessário"
});

extend("email", {
  ...email,
  message: "IInforme um e-mail válido"
});

extend("min", {
  ...min,
  validate(value, { length }) {
    return value.length >= length;
  },
  params: ['length'],
  message: 'Este campo precisa de precisa ter no mínimo {length} caracteres'
});
  
extend("max", {
  ...max,
  validate(value, { length }) {
    return value.length <= length;
  },
  params: ['length'],
  message: 'Este campo precisa de precisa ter no máximo {length} caracteres'
});
