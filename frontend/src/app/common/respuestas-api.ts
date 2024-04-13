export type RespuestaAPIPaginada<T> = {
  statusCode: string;
  message: string;
  data: {
    current_page: number;
    data: T;
  };
};

export type RespuestaAPI<T> = {
  statusCode: string;
  message: string;
  data: T;
};
