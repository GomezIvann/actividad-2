export type RespuestaAPIPaginada<T> = {
  status: string;
  message: string;
  data: {
    current_page: number;
    data: T;
  };
};

export type RespuestaAPI<T> = {
  status: string;
  message: string;
  data: T;
};
