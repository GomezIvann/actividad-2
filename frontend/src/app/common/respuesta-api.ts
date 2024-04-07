export type RespuestaApi<T> = {
  status: string;
  message: string;
  data: T;
};
