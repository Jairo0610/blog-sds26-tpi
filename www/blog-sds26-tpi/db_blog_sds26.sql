--
-- PostgreSQL database dump
--

\restrict yldtJ3X56pIH9lVe0g0bm56tAuxSSUJjpIBIxpAZ9bK9TG85gtg0gNXu52XqLU3

-- Dumped from database version 17.11 (Debian 17.11-1.pgdg13+2)
-- Dumped by pg_dump version 17.11 (Debian 17.11-1.pgdg13+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: actividades; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.actividades (
    id bigint NOT NULL,
    nombre character varying(150) NOT NULL,
    descripcion text,
    fecha_hora timestamp(0) without time zone NOT NULL,
    lugar character varying(100) NOT NULL,
    categoria_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: actividades_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.actividades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: actividades_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.actividades_id_seq OWNED BY public.actividades.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


--
-- Name: categorias; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.categorias (
    id bigint NOT NULL,
    nombre character varying(100) NOT NULL,
    slug character varying(120) NOT NULL,
    descripcion text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: categorias_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.categorias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: categorias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.categorias_id_seq OWNED BY public.categorias.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


--
-- Name: jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


--
-- Name: post_images; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.post_images (
    id bigint NOT NULL,
    ruta character varying(255) NOT NULL,
    descripcion character varying(200),
    orden smallint DEFAULT '0'::smallint NOT NULL,
    post_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    usuario_id bigint
);


--
-- Name: post_images_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.post_images_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: post_images_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.post_images_id_seq OWNED BY public.post_images.id;


--
-- Name: post_user; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.post_user (
    post_id bigint NOT NULL,
    usuario_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: posts; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.posts (
    id bigint NOT NULL,
    titulo character varying(200) NOT NULL,
    slug character varying(220) NOT NULL,
    fecha_actividad date NOT NULL,
    resumen character varying(300),
    contenido text NOT NULL,
    imagen_principal character varying(255),
    estado character varying(255) DEFAULT 'borrador'::character varying NOT NULL,
    publicado_en timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    usuario_id bigint NOT NULL,
    categoria_id bigint NOT NULL,
    actividad_id bigint,
    CONSTRAINT posts_estado_check CHECK (((estado)::text = ANY ((ARRAY['borrador'::character varying, 'publicado'::character varying])::text[])))
);


--
-- Name: posts_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.posts_id_seq OWNED BY public.posts.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    carnet character varying(10),
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: actividades id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.actividades ALTER COLUMN id SET DEFAULT nextval('public.actividades_id_seq'::regclass);


--
-- Name: categorias id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorias ALTER COLUMN id SET DEFAULT nextval('public.categorias_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: post_images id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.post_images ALTER COLUMN id SET DEFAULT nextval('public.post_images_id_seq'::regclass);


--
-- Name: posts id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posts ALTER COLUMN id SET DEFAULT nextval('public.posts_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: actividades; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.actividades (id, nombre, descripcion, fecha_hora, lugar, categoria_id, created_at, updated_at) FROM stdin;
4	Ponencia 1	Investigación aplicada en IoT para la agricultura en El Salvador.	2026-11-16 10:00:00	Auditorio 1	1	2026-11-21 00:01:00	2026-11-21 00:01:00
5	Ponencia 2	Energías alternativas y eficiencia energética.	2026-11-16 13:00:00	Auditorio 1	1	2026-11-21 00:01:00	2026-11-21 00:01:00
6	Ponencia 3	Eficiencia energética, optimización de recursos y sostenibilidad aplicada a soluciones tecnológicas.	2026-11-17 08:00:00	Auditorio 1	1	2026-11-21 00:01:00	2026-11-21 00:01:00
7	Ponencia 4	Ciberseguridad ESET	2026-11-17 10:00:00	Auditorio 1	1	2026-11-21 00:01:00	2026-11-21 00:01:00
8	Taller	Sostenibilidad digital y análisis energético mediante Electricity Map.	2026-11-17 13:00:00	Auditorio 1	2	2026-11-21 00:01:00	2026-11-21 00:01:00
9	Bingo	Bingo de la Semana de Sistemas.	2026-11-18 08:00:00	Auditorio 1	3	2026-11-21 00:01:00	2026-11-21 00:01:00
10	Expo Systems	Los proyectos más innovadores realizados por los estudiantes de Ingeniería de Sistemas Informáticos.	2026-11-19 08:00:00	Plaza Minerva	4	2026-11-21 00:01:00	2026-11-21 00:01:00
11	Comelona de pizza	¿Eres tan veloz para ganar?	2026-11-19 12:00:00	Plaza Minerva	5	2026-11-21 00:01:00	2026-11-21 00:01:00
12	Torneo futsal	Partidos frenéticos, 5 jugadores por equipo.	2026-11-20 08:00:00	Cancha futsal	6	2026-11-21 00:01:00	2026-11-21 00:01:00
13	Parrillada	Un momento para disfrutar todos y convivir.	2026-11-20 12:00:00	Alrededores de la cancha	7	2026-11-21 00:01:00	2026-11-21 00:01:00
\.


--
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.categorias (id, nombre, slug, descripcion, created_at, updated_at) FROM stdin;
1	Ponencias	ponencias	Tema, expositor, ideas centrales y aprendizajes.	2026-11-21 00:00:31	2026-11-21 00:00:31
2	Talleres	talleres	Herramientas, procedimiento, práctica y resultados.	2026-11-21 00:00:31	2026-11-21 00:00:31
3	Bingo	bingo	Dinámica, experiencia y participación.	2026-11-21 00:00:31	2026-11-21 00:00:31
4	Feria de proyectos	feria-de-proyectos	Proyectos visitados, tecnologías e innovación.	2026-11-21 00:00:31	2026-11-21 00:00:31
5	Comelona de pizza	comelona-de-pizza	Desarrollo, convivencia y experiencia.	2026-11-21 00:00:31	2026-11-21 00:00:31
6	Torneo de fútbol sala	torneo-de-futbol-sala	Desarrollo, equipos y participación como jugador o espectador.	2026-11-21 00:00:31	2026-11-21 00:00:31
7	Parrillada	parrillada	Descripción, convivencia y reflexión.	2026-11-21 00:00:31	2026-11-21 00:00:31
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.migrations (id, migration, batch) FROM stdin;
19	0001_01_01_000000_create_users_table	1
20	0001_01_01_000001_create_cache_table	1
21	0001_01_01_000002_create_jobs_table	1
22	2026_11_17_180520_create_categorias_table	1
23	2026_11_17_180532_create_actividades_table	1
24	2026_11_17_180548_create_posts_table	1
25	2026_11_17_180555_create_post_user_table	1
26	2026_11_17_180559_create_post_images_table	1
27	2026_11_17_180807_create_evidencias_table	1
28	2026_11_21_100000_add_usuario_id_to_post_images_table	2
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: post_images; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.post_images (id, ruta, descripcion, orden, post_id, created_at, updated_at, usuario_id) FROM stdin;
27	posts/galeria/u0JqOEUDL37UwN4EvtwBXJ8fIwQ4f97yXD5O3jQU.jpg	\N	5	3	2026-11-21 13:27:23	2026-11-21 13:27:23	2
28	posts/galeria/0Bnza47kwJIuQNdGb2rfoQnXEOblDTPHS5xLdB2u.jpg	\N	1	4	2026-11-21 13:27:52	2026-11-21 13:27:52	1
29	posts/galeria/LJ9gFfuTzXLnHAa0oVSWFrzmejg4LHFU509SgLSp.jpg	\N	2	4	2026-11-21 13:27:52	2026-11-21 13:27:52	1
30	posts/galeria/7hqepd8EECS7dWTgrcTuZklr5uG737AzPpczmJVY.jpg	\N	3	4	2026-11-21 13:27:52	2026-11-21 13:28:20	2
31	posts/galeria/eWMOWkrWokdPuVlV4sAm8AQmGjk04nQcXpsOWB9g.jpg	\N	4	4	2026-11-21 13:28:39	2026-11-21 13:28:44	1
32	posts/galeria/6hIru6up83pHVhRG57xutbp99DLjkVy6cuehLo3L.jpg	\N	5	4	2026-11-21 13:28:39	2026-11-21 13:28:47	2
19	posts/galeria/27hx0iiyPEkK2xkjuFdcGu5h7LW6QR9tytxSQdiU.jpg	Arquitectura de Estanque: Acuicultura	3	2	2026-11-21 12:15:41	2026-11-21 12:16:50	2
17	posts/galeria/mrPVGCx0X2DtAASY5a0j37vRWcqaE2R05m0fGw27.jpg	El fenómeno y la pregunta científica dictan la arquitectura	1	2	2026-11-21 12:15:41	2026-11-21 12:17:41	1
18	posts/galeria/WkI8EncLNy2ZvSaBQoLlYLIEcM7iR9FggoNipy7T.jpg	Flujo Portátil: Suelos	2	2	2026-11-21 12:15:41	2026-11-21 12:18:00	1
20	posts/galeria/QxGD8iczBFUCyDQALGSU85SLQLnZU43uVMkfq9jQ.jpg	Topología Resiliente: TURTLE26	4	2	2026-11-21 12:15:41	2026-11-21 12:18:28	2
22	posts/galeria/fzTW2ScuSZJBHTCUfrQJmmfSJSFF9Z2HQEuPKacv.jpg	Evidencia de asistenncia a la ponencia	5	2	2026-11-21 12:18:58	2026-11-21 12:19:14	\N
23	posts/galeria/qSIHRxBaALjPIgvXpJJamBia8N1rqnNFXBiJIlPL.jpg	\N	1	3	2026-11-21 13:26:53	2026-11-21 13:26:53	1
24	posts/galeria/FLY3UHbAOOrskSuRftfCshLNchwoatgVAgUWwKcT.jpg	\N	2	3	2026-11-21 13:26:53	2026-11-21 13:26:53	1
25	posts/galeria/NwO9vuo0WfJYREjRFjo4jk19lb95Txj1yL0NzJfM.jpg	\N	3	3	2026-11-21 13:26:53	2026-11-21 13:26:53	1
26	posts/galeria/jUm4AUwmYHx7b2PUgC0Oi0sstV6nPU3UebypEv9p.jpg	\N	4	3	2026-11-21 13:27:10	2026-11-21 13:27:10	\N
33	posts/galeria/S6Stf4m8SsjNMtUwJC9sxccHTiX5xlQBaXJinSKB.jpg	\N	6	4	2026-11-21 13:28:39	2026-11-21 13:28:49	1
39	posts/galeria/pO1qUSlizNfeO8bucS6AYDOADcgCeiLvvvSwn8vJ.jpg	\N	6	5	2026-11-21 13:29:30	2026-11-21 13:29:44	2
38	posts/galeria/uCF7QvCOAJdvsEk3D33uVjueSWZOmk4qEwQvQ1CT.jpg	\N	5	5	2026-11-21 13:29:30	2026-11-21 13:29:47	1
34	posts/galeria/kkEspaH39psAzFrlLkhR08OK5BXLCm82yKWgdl7I.jpg	\N	1	5	2026-11-21 13:29:30	2026-11-21 13:29:51	1
35	posts/galeria/UMAhakoSACAqsN98rksG6QOivv35p33nDRPZUO1e.jpg	\N	2	5	2026-11-21 13:29:30	2026-11-21 13:29:52	2
36	posts/galeria/rgcogiB42xcOYIp1EKgOEHyuBIxJdp5VKDBhmyD4.jpg	\N	3	5	2026-11-21 13:29:30	2026-11-21 13:29:54	2
37	posts/galeria/A11tyBTqphiejVjgzHlWpYjrG709fXJw1x6lwqzQ.jpg	\N	4	5	2026-11-21 13:29:30	2026-11-21 13:29:57	2
47	posts/galeria/1eFXhX9YF17NWOahfIWsRrQ7V91LOEkqmZqF3Zkr.jpg	\N	8	6	2026-11-21 13:30:30	2026-11-21 13:30:44	1
46	posts/galeria/duzddwdDYWzzIllKZBdnJzoodSeUxsSjSCtNYYHq.jpg	\N	7	6	2026-11-21 13:30:30	2026-11-21 13:30:46	1
45	posts/galeria/B8CJPxYAof7mo8qHqMVEq5HIVDtZOxjgZq17XwDm.jpg	\N	6	6	2026-11-21 13:30:30	2026-11-21 13:30:48	1
44	posts/galeria/51EFVg2vm6Yt5LhxxerKDzIaeaDqwtzryToaNVyV.jpg	\N	5	6	2026-11-21 13:30:30	2026-11-21 13:30:50	1
43	posts/galeria/XTkoVOyjjBql0IxwsNX7z5N6Xqn1J9JyNQyXuqCp.jpg	\N	4	6	2026-11-21 13:30:30	2026-11-21 13:30:52	2
42	posts/galeria/V7PJyG3bpuHaEswU0oTDWT0bQLBRKL9g4UrZbcEz.jpg	\N	3	6	2026-11-21 13:30:30	2026-11-21 13:30:55	2
41	posts/galeria/aaGIhV4tELcBFWQkwiqXSGznenfSBtgnYmPeewBI.jpg	\N	2	6	2026-11-21 13:30:30	2026-11-21 13:30:57	2
40	posts/galeria/SvPlyz9dpS8l99b2xAD0yeKmeplZFkMPmic5Ih5u.jpg	\N	1	6	2026-11-21 13:30:30	2026-11-21 13:30:59	2
50	posts/galeria/SYDZeSRfnPuKr0xe4bJ8LRZn3roH3M0qlxg0iaPo.jpg	\N	3	8	2026-11-21 13:46:15	2026-11-21 13:46:15	1
51	posts/galeria/aqTe4EEE4KbGWV1Bc3fuqpChSSYRU7aopMBf4yac.jpg	\N	4	8	2026-11-21 13:46:15	2026-11-21 13:46:15	1
52	posts/galeria/UrDuwYs7xAJnVWVAMfqFly5c58r3luObxTXJuHGK.jpg	\N	5	8	2026-11-21 13:46:15	2026-11-21 13:46:15	1
53	posts/galeria/43nKsCh9YwA03EFmqxn9DqC8VDv6yslubjOY88m6.jpg	\N	6	8	2026-11-21 13:46:15	2026-11-21 13:46:15	1
54	posts/galeria/bZmQoZ9HnrgxaO8OKW5Inx3rsRjrCHsp0vyFnvuO.jpg	\N	7	8	2026-11-21 13:46:15	2026-11-21 13:46:15	1
55	posts/galeria/2K327nWT3BmEY10zB4pyjlITDyckGzNVSqRfkOvv.jpg	\N	8	8	2026-11-21 13:46:34	2026-11-21 13:46:34	2
56	posts/galeria/id7TCOIVRwRdmQw44ur7jzz0rKzyFjMb9AK5zNvg.jpg	\N	9	8	2026-11-21 13:47:36	2026-11-21 13:47:36	1
48	posts/galeria/PI2ZFqWBjXwMR0H9eb3XBV0WYM3hoFFVmZdrCZdD.jpg	\N	1	8	2026-11-21 13:46:15	2026-11-21 13:47:43	2
49	posts/galeria/kcFL55OseI2t2ojrcsFitT2X79Lg1U8zb40z28aX.jpg	\N	2	8	2026-11-21 13:46:15	2026-11-21 13:47:45	2
58	posts/galeria/dJi7zI845EQFinPfYIWdI8NuzlRJ7X0l7jivcJNi.jpg	\N	2	7	2026-11-21 13:48:26	2026-11-21 13:48:26	1
59	posts/galeria/paITIR6l5cpLnZetTfc4ReHKK5AGVqO9OueQbG3n.jpg	\N	3	7	2026-11-21 13:48:26	2026-11-21 13:48:26	1
60	posts/galeria/06f5TI0frfhDAjbCfFGiXEYqDtZ9qw5Kz7aV2Yif.jpg	\N	4	7	2026-11-21 13:48:26	2026-11-21 13:48:26	1
61	posts/galeria/dTMAco05ShBQVCuaLiTsyC3WxWhvRCFBc7t3Weaf.jpg	\N	5	7	2026-11-21 13:48:26	2026-11-21 13:48:26	1
62	posts/galeria/dnkuogLjHS1ZZRRPYqG2dwH6i2nBghJblCaE0zn0.jpg	\N	6	7	2026-11-21 13:49:07	2026-11-21 13:49:07	2
63	posts/galeria/Ujka8l8gzFXXZyGw8vczo022zAuNqDVvtnspej5Y.jpg	\N	7	7	2026-11-21 13:49:07	2026-11-21 13:49:07	2
64	posts/galeria/7IGdVDjVRBrO2kbbezKacYHGtTQTSwZA7KNOUfgS.jpg	\N	1	9	2026-11-21 13:50:03	2026-11-21 13:50:03	2
65	posts/galeria/LJBy25KVelFXhysobb52m6oOKFqXFaNTbbCwilQc.jpg	\N	2	9	2026-11-21 13:50:18	2026-11-21 13:50:18	1
66	posts/galeria/0xsJV0jFN0Kf0fBrJKln7mKaZlLPuYhd5ThoHQoz.jpg	\N	3	9	2026-11-21 13:50:18	2026-11-21 13:50:18	1
67	posts/galeria/iqNjujooKeht6maawACjNHcKhVBBEAk6syovb5IY.jpg	\N	1	11	2026-11-21 13:51:10	2026-11-21 13:51:10	1
68	posts/galeria/1a1AnkjASSMl0MzNRkbZNhqkdIj6qTJj868eQ3Bp.jpg	\N	2	11	2026-11-21 13:51:47	2026-11-21 13:51:47	2
69	posts/galeria/x5fZLaTcbGuRg7Pjf7qIyH57BDdUEdWzD6sOmNCz.jpg	\N	3	11	2026-11-21 13:51:47	2026-11-21 13:51:51	\N
71	posts/galeria/FVigpW8POjlvUvxUWi3TpTOS44sF1lu0BTk7Jhhs.jpg	Participación de Jairo en el torneo de futsal	2	10	2026-11-21 13:52:56	2026-11-21 13:53:18	1
72	posts/galeria/G6j0o4h9YwMbWqxVG58t5EoJs1JnyHMBNE6b4J4X.jpg	Trofeo	3	10	2026-11-21 13:52:56	2026-11-21 13:53:31	1
70	posts/galeria/bWdER8CaH3yXeXtxgqeXIRuddohJtBgA6L0ytg7h.jpg	Campeones	1	10	2026-11-21 13:52:14	2026-11-21 13:53:37	2
\.


--
-- Data for Name: post_user; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.post_user (post_id, usuario_id, created_at, updated_at) FROM stdin;
2	1	2026-11-21 12:09:32	2026-11-21 12:09:32
2	2	2026-11-21 12:09:32	2026-11-21 12:09:32
3	1	2026-11-21 12:22:18	2026-11-21 12:22:18
3	2	2026-11-21 12:22:18	2026-11-21 12:22:18
4	1	2026-11-21 12:27:48	2026-11-21 12:27:48
4	2	2026-11-21 12:27:48	2026-11-21 12:27:48
5	1	2026-11-21 12:32:51	2026-11-21 12:32:51
5	2	2026-11-21 12:32:51	2026-11-21 12:32:51
6	1	2026-11-21 12:34:49	2026-11-21 12:34:49
6	2	2026-11-21 12:34:49	2026-11-21 12:34:49
7	1	2026-11-21 13:00:30	2026-11-21 13:00:30
7	2	2026-11-21 13:00:30	2026-11-21 13:00:30
8	1	2026-11-21 13:05:14	2026-11-21 13:05:14
8	2	2026-11-21 13:05:14	2026-11-21 13:05:14
9	1	2026-11-21 13:09:35	2026-11-21 13:09:35
9	2	2026-11-21 13:09:35	2026-11-21 13:09:35
10	1	2026-11-21 13:23:06	2026-11-21 13:23:06
10	2	2026-11-21 13:23:06	2026-11-21 13:23:06
11	1	2026-11-21 13:25:52	2026-11-21 13:25:52
11	2	2026-11-21 13:25:52	2026-11-21 13:25:52
\.


--
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.posts (id, titulo, slug, fecha_actividad, resumen, contenido, imagen_principal, estado, publicado_en, created_at, updated_at, usuario_id, categoria_id, actividad_id) FROM stdin;
3	Ponencia 2: Energías alternativas y eficiencia energética: lo que no se mide no se gestiona	ponencia-2-energias-alternativas-y-eficiencia-energetica-lo-que-no-se-mide-no-se-gestiona	2026-11-16	\N	Después del almuerzo, y de salir un rato al sol a quitarnos el frío de la mañana, regresamos al auditorio para la ponencia del doctor Carlos Pocasangre. Empezó proyectando el clima de San Miguel en ese momento: 35 °C. Con eso explicó que la temperatura y la humedad del ambiente deciden si somos buenos o malos usuarios de la energía. Habló de energía en general, no solo de la eléctrica, y nos hizo notar que dentro del auditorio hacía frío mientras afuera estaba caliente. Él mismo contó que tuvo que sacar la chumpa porque empezó a temblar sentado.\r\nLa charla giró alrededor de la frase de William Pepperell Montague "lo que no se puede medir, no se puede gestionar". A partir de ahí presentó la pirámide energética: primero conservar energía, después ser eficientes y al final usar fuentes renovables. Para él, ser eficiente es gastar menos sin perder confort, productividad ni calidad de vida. Lo acompañó con memes del aire acondicionado y de la refrigeradora abierta que hicieron reír a todo el auditorio.\r\nNos contó que en un edificio los aires acondicionados son los equipos que más electricidad consumen, y lo relacionó con nuestra carrera. Según él, la idea de que un cuarto de servidores tiene que estar a 18 °C viene más del confort de las personas que de los equipos, porque un microprocesador moderno aguanta entre 80 y 85 °C. Otra cosa son los centros de datos con aceleradores de IA, como las tarjetas NVIDIA H200, que se mantienen entre 5 y 10 °C todo el año. Por esa demanda eléctrica, algunas ciudades de Estados Unidos y Europa ya prohibieron instalar nuevos centros de datos. Nos advirtió que tarde o temprano nos va a tocar trabajar en uno de esos cuartos fríos.\r\nPara explicar la eficiencia en la vida diaria usó dos ejemplos. Las refrigeradoras de las tiendas de conveniencia tienen puertas de doble vidrio con cámara de vacío para que no se empañen; si uno abre la puerta sin haber decidido qué va a llevar, entra calor y el consumo se dispara. El otro ejemplo fue que una refrigeradora llena gasta menos que una vacía, porque la comida guarda el frío y funciona como un capacitor térmico, mientras que en una vacía el aire frío se sale apenas se abre. También habló del síndrome del edificio enfermo, que aparece cuando los filtros de los aires no reciben mantenimiento y acumulan bacterias y hongos.\r\nEn la parte nacional mostró el portal de estadísticas de la SIGET con la capacidad instalada por tecnología, el mapa de generación distribuida y el plan maestro de energías renovables hecho con JICA en 2012. Repasó las hidroeléctricas (15 de Septiembre, 5 de Noviembre y El Chaparral), las geotérmicas de Ahuachapán y Berlín, la planta de gas natural de Energía del Pacífico en Acajutla con unos 380 MW, el primer parque eólico del país (Ventus, en Metapán, con 54 MW) y plantas de biogás de 5 MW en Opico. Habló de calentadores y colectores solares, de biodigestores que aprovechan el estiércol de cerdos y gallinas, de las bombas de ariete que suben agua sin electricidad, de la propuesta de hidrógeno verde y del debate sobre la energía nuclear.\r\nNo todo fue positivo. Advirtió que en El Salvador no hay legislación para disponer de los desechos de más de 100,000 paneles fotovoltaicos, de las aspas de los aerogeneradores, que miden unos 80 m, ni del plomo y el ácido de las baterías. También enseñó una comparación de temperaturas en una calle sin árboles, donde el asfalto llegaba a 66 °C, contra una calle arbolada que estaba entre 25 y 30 °C.\r\nSobre investigación, citó el estudio japonés COOLBIZ, que evaluó oficinas a 28 °C, y mostró un artículo suyo publicado en la revista Minerva sobre un medidor de bajo costo para la eficiencia de los aires acondicionados. Terminó con la norma ISO 50001, la certificación de personas NTS 27.47.01:23 y las categorías de la certificación LEED para edificios sostenibles. Se despidió con un "gracias por ser eficientes".\r\nA Yanira le sorprendió que, a su hermana, que seguía con nosotros, sí le gustaron los temas y que entendió buena parte de la charla.\r\n\r\nReflexión: Nos sirvió para ver la energía como un tema de sistemas y no solo de electricistas. Un centro de datos o un dispositivo también se evalúa por cuánto calor genera y cuánta electricidad consume, no solo por su capacidad de cómputo. Si un día diseñamos un sistema que mide consumo o controla equipos, lo primero es tener buenos datos. También nos dejó pensando en lo que gastamos en casa con el aire o con los aparatos que dejamos conectados.	posts/XAMj1YXdteIHZwlxcQf7cbNJxP1MyMEkhSca8BpO.jpg	publicado	2026-11-21 12:22:18	2026-11-21 12:22:18	2026-11-21 12:22:18	3	1	5
6	Taller: Sostenibilidad digital y análisis energético con Electricity Maps	taller-sostenibilidad-digital-y-analisis-energetico-con-electricity-maps	2026-11-17	Con nuestro compañero Josué González aprendimos a calcular cuánto CO2 emite un equipo según la red eléctrica que lo alimenta, y usamos Electricity Maps y su API para comparar El Salvador con Guatemala a la misma hora.	Herramientas: Electricity Maps (mapa web), la API v4 de Electricity Maps y Electricity Lab, una página de práctica preparada para la Semana de Sistemas con un playground para hacer consultas. Usamos laptop y celular\r\n\r\nDespués del almuerzo siguió el taller, que impartió nuestro compañero Josué González. Estaba planificado para 120 minutos y siguió ocho temas: infraestructura y Green IoT, emisiones y mezcla eléctrica, potencia y energía, CO2 equivalente, ahorro con Green IoT, uso de Electricity Maps, comparación de zonas y horas, y práctica con los equipos. Buena parte fue explicación, casi como una ponencia, pero al final sí trabajamos con la laptop y el celular. Motiva ver a alguien de la misma carrera exponiendo un tema así.\r\nPrimero se habló de la "infraestructura invisible": cada actividad digital usa dispositivos, redes y centros de datos que consumen energía. Luego vimos de dónde sale la electricidad. Los combustibles fósiles liberan CO2 al quemarse; las renovables y la nuclear tienen pocas emisiones directas, aunque también tienen impacto en su fabricación. La electricidad que consume una zona mezcla lo que produce y lo que importa o exporta en el Mercado Eléctrico Regional.\r\nProcedimiento: repasamos las bases de cálculo. La energía se obtiene con Wh = W × h, así que un equipo de 100 W encendido 2 horas gasta 200 Wh. Las emisiones salen de multiplicar la energía por la intensidad de carbono de la red (g CO2eq = kWh × g CO2eq/kWh). En el ejercicio guiado, una estación de 250 W durante 2 horas consume 0.50 kWh; en una red con 520 g/kWh eso da 260 g, y en una red más limpia da 60 g, una diferencia de 200 g por la misma tarea.\r\nDespués vino un ejemplo de Green IoT medible: cuatro computadoras inactivas durante una hora en espera gastan 4 × 50 W = 200 W, o sea 0.200 kWh. Si un sensor las suspende, el consumo baja a 4 × 5 W más 8 W del sensor, 28 W, o 0.028 kWh. El ahorro estimado en esa hora es de 0.172 kWh.\r\nPráctica: abrimos Electricity Maps y aprendimos a leer el mapa de intensidad de carbono, a cambiar la fecha y el período y a revisar la mezcla de fuentes, los flujos y la demanda. También a distinguir los datos preliminares, estimados y de pronóstico. Luego comparamos El Salvador con Guatemala a la misma hora: El Salvador tenía 160 g/kWh con 38 % de solar y Guatemala 410 g/kWh con 39 % hidro. La misma tarea de 0.50 kWh emitía 80 g en un país y 205 g en el otro. Al final entramos desde el celular a Electricity Lab y ejecutamos una consulta a la API v4 para ver la intensidad de carbono de la zona SV.\r\n\r\nResultados y reflexión: aprendimos a calcular las emisiones de un equipo y a leer datos reales de la red eléctrica. Nos sorprendió que la misma computadora contamine distinto según el país y la hora en que se usa. Nos llevamos la idea de que un sistema también se puede programar para gastar menos, por ejemplo consultando con menos frecuencia, agrupando envíos o mandando a dormir los sensores entre lecturas.	posts/OupcYLust5pdUZyc1CHwzj5zhOTiHYcXVjf3gkUr.jpg	publicado	2026-11-21 12:34:49	2026-11-21 12:34:49	2026-11-21 12:34:49	1	2	8
2	Ponencia 1: Del internet de las cosas a la investigación aplicada en el agro salvadoreño	ponencia-1-del-internet-de-las-cosas-a-la-investigacion-aplicada-en-el-agro-salvadoreno	2026-11-16	\N	La Semana de Sistemas 2026 empezó para nosotros con esta ponencia en el auditorio. El ingeniero Omar Flores Cortez quién explicó el IoT desde un punto de vista que no esperábamos: para él, un sistema de internet de las cosas es una forma de convertir un fenómeno físico en evidencia científica. La temperatura de un gallinero, el amoníaco en un chiquero o el CO2 que sale de una fumarola son fenómenos, y el trabajo del ingeniero es medirlos, convertirlos en datos y subirlos a la nube para que alguien pueda tomar decisiones con ellos.\r\nUno de los datos que más nos llamó la atención fue que en El Salvador el 85 % de los agricultores no usa datos para decidir. Casi todo el agro es familiar y se maneja por experiencia. Muchos productores tampoco pueden pagar equipos importados de España, Alemania o Japón que cuestan miles de dólares y que a veces ni se adaptan a la red eléctrica o a las telecomunicaciones del país. Ahí, según el expositor, hay una oportunidad para nosotros: hacer soluciones de bajo costo desarrolladas aquí.\r\nDespués pasó a la parte técnica. Un sistema IoT se puede ver en cinco capas: percepción, procesamiento o nodo, red, plataforma en la nube y aplicación. Bromeó con que las tres primeras son de los electricistas y electrónicos y las dos últimas de los ingenieros de sistemas. En la percepción entran sensores electroquímicos, electromagnéticos o de gas, y para elegir uno hay que pensar en la variable, el rango, la exactitud, el tiempo de respuesta y el costo total. Lo explicó con la asistencia del mismo auditorio: se puede contar a la gente con una barrera de luz, con cámaras, contando señales Bluetooth o con gafetes RFID, y cada opción cambia la exactitud y el precio.\r\nTambién habló de decisiones que uno no piensa al principio, como cada cuánto enviar datos. No es lo mismo mandar una lectura por segundo que promediar diez minutos y mandar un solo paquete; eso cambia el ancho de banda y el costo. Repasó las tecnologías de enlace (wifi, Bluetooth, LoRa/LoRaWAN y red celular), el protocolo MQTT y la técnica store and forward: si se cae el wifi, el nodo guarda el dato en su memoria y lo envía cuando vuelve la conexión. Comparó la telemetría aislada, que solo manda lecturas, con una arquitectura que procesa parte de los datos en el borde (edge), algo que tiene sentido en zonas agrícolas donde la conectividad es mala y cara.\r\nMostró proyectos de su grupo de investigación: estaciones de calidad del aire con sensores PM2.5 y un ESP32-C3 que envían por MQTT/TLS, un flujo con imágenes satelitales para estudiar manglares, una sonda portátil NPK para suelos, el monitoreo de estanques de acuicultura con LoRa y la topología TURTLE26, que guarda los datos en tarjeta SD cuando no hay conectividad. Contó que midieron CO2 en volcanes con un dispositivo Bluetooth conectado al teléfono, y mencionó a estudiantes del campus central de la UES que usan un espectrómetro para detectar a tiempo la roya en las hojas del café.\r\nCerró con una idea que nos quedó grabada: "una prueba de comunicación exitosa no valida el sensor; una plataforma operativa no demuestra utilidad científica". La ruta que propuso va de requisitos a prototipo, verificación en laboratorio, validación en campo y evaluación en contexto.\r\nA media mañana el aire acondicionado del auditorio ya nos tenía congelados, así que el cafecito que repartieron nos cayó muy bien. Ese día Yanira llevó a su hermana, que el próximo año entra a la universidad, para que fuera conociendo el ambiente. Los compañeros no perdieron la oportunidad de bromear y le preguntaban por qué la había "castigado" llevándola a una ponencia técnica, pero al final la pasaron bien.\r\n\r\nReflexión: Salimos con otra idea de lo que puede ser un proyecto de sistemas. Siempre pensamos en la investigación como algo de encuestas, y aquí vimos que un prototipo bien validado en campo puede convertirse en una tesis o en un artículo. Nos quedamos con la parte de pensar primero en el problema y en el usuario, y después en la tecnología.	posts/mMeyYyiyEpIJQZlujgCgFZGCA4VGTp3fDbIp4WxH.jpg	publicado	2026-11-21 12:09:32	2026-11-21 12:09:32	2026-11-21 12:24:09	3	1	4
4	Ponencia 3: Eficiencia energética, optimización de recursos y sostenibilidad aplicada a soluciones tecnológicas: automatización de aires acondicionados mediante IoT, BACnet e IA.	ponencia-3-eficiencia-energetica-optimizacion-de-recursos-y-sostenibilidad-aplicada-a-soluciones-tecnologicas-automatizacion-de-aires-acondicionados-mediante-iot-bacnet-e-ia	2026-11-17	Green IoT: automatizar aires acondicionados con IoT, BACnet e IA	El martes arrancó con una pregunta: ¿cuántos aires acondicionados quedan encendidos esta noche en oficinas vacías de tu ciudad? A partir de ahí, el licenciado Nahum Sánchez nos contó un caso real. Una empresa tenía un sistema VRF moderno, que climatiza varias zonas, pero lo controlaba como hace 20 años: desde una pantalla táctil en la pared que nadie revisaba. Ya tenía instalado un gateway BACnet que nadie aprovechaba. Lo que faltaba era el código.\r\nExplicó el IoT como objetos que miden, comunican y obedecen, y dejó claro que el IoT no es solo Arduino: aires, medidores, bombas y luces industriales también cuentan. Su solución tiene cuatro capas. Las unidades VRF con sus sensores son la percepción, el gateway BACnet es la comunicación, una API en .NET hace el procesamiento y un panel web es la aplicación.\r\nLa parte que más entendimos fue la de los protocolos. Con Modbus el equipo responde algo como "registro 40001 = 245" y hay que buscar en el manual qué significa. Con BACnet la respuesta ya trae sentido: "temperatura zona 2 = 24.5 °C". Lo comparó con lo que vemos en programación: el programa en C# pasa a lenguaje intermedio, el JIT lo interpreta y llega a lenguaje de máquina. El gateway hace de intérprete, no de compilador.\r\nHizo una demostración en vivo del panel. Desde ahí se ven las zonas, se lee la temperatura, se cambia el punto de ajuste y se apaga un equipo. La aplicación programa encendidos por horario, limita la temperatura entre 22 y 26 °C, muestra el estado en tiempo real, manda alertas de fallas y apaga las zonas olvidadas el fin de semana. El resultado que mostró fue menos horas encendidas con el mismo confort, sin comprar hardware nuevo, porque se reutilizó el gateway que ya existía.\r\nEn la última parte habló de pasar de medir a predecir: primero estadística simple, luego machine learning para detectar anomalías y después modelos de lenguaje que entiendan órdenes como "enciende la zona 3 a 24 °C". Dijo que MCP es a la IA lo que BACnet es a los equipos. Fue honesto con el tema de la IA: no es verde por sí misma, porque consume energía. En su caso la usó para construir la aplicación, y la aplicación funcionando no usa IA; ahorra con reglas fijas todos los días.\r\n\r\nReflexión: Nos quedamos con su frase final: "Green IoT no es comprar más tecnología: es usar mejor la que ya existe". Muchas veces pensamos que un proyecto necesita equipo caro, y aquí el ahorro vino de escribir software para algo que ya estaba instalado. Nos gustó ver conceptos de clase, como intérpretes, APIs y arquitectura en capas, funcionando en un edificio real y ahorrando dinero y energía.	posts/AWODEj4rs9E8ADpLqoArRGLsZeNw9UIsvQWnGvYe.jpg	publicado	2026-11-21 12:27:48	2026-11-21 12:27:48	2026-11-21 12:27:48	1	1	6
5	Ponencia 4: Ciberseguridad con ESET: el usuario como primera línea de defensa	ponencia-4-ciberseguridad-con-eset-el-usuario-como-primera-linea-de-defensa	2026-11-17	Human Risk Management: el usuario como primera línea de defensa, y "60 minutos": un ataque real paso a paso	Después de la ponencia 3 se desarrolló la ponencia 4 que trató sobre ciberseguridad con personas de ESET. Tuvo dos partes, la primera estuvo a cargo de Victoria Rivas, con el tema Human Risk Management, abrió con la frase "los hackers atacan sistemas; los ciberdelincuentes manipulan personas" y explicó que gestionar el riesgo humano no es buscar culpables, sino entender los riesgos, reducir errores y convertir a cada colaborador en una línea de defensa.\r\nSegún el Data Breach Investigations Report 2025 de Verizon Business que mostró, el 60 % de las brechas involucró un elemento humano, el 30 % a un tercero y el 17 % tuvo como motivo el espionaje. En El Salvador, el 14.5 % de las personas ha sufrido un ataque de phishing. Por eso es más fácil manipular a una persona que comprometer toda una infraestructura. Definió la ingeniería social como el uso de manipulación psicológica y engaño para que alguien revele información o dé acceso a un sistema, y mostró los tres disparadores más usados: urgencia ("su cuenta bancaria ha sido vulnerada"), curiosidad ("usted ganó $50,000") y confianza o autoridad ("soy del departamento de TI").\r\nRepasó cómo cambiaron los ataques: del hackeo técnico de los años 80 al 2000, al spear phishing con información de LinkedIn y redes sociales, hasta la IA generativa, que desde 2023 redacta correos sin faltas de ortografía y permite deepfakes de voz y video. Explicó el fraude BEC (Business Email Compromise), donde el atacante se hace pasar por un ejecutivo o proveedor y pide secreto para saltarse la regla de los cuatro ojos, y enseñó un correo falso que suplantaba a un banco de la región. También mencionó filtraciones que han pasado en el país, como la de datos de 5.1 millones de salvadoreños, la exposición de código y credenciales de Chivo Wallet y los datos de cotizantes del ISSS. Cerró con la idea de que la adopción de la IA avanza más rápido que su gobernanza.\r\nLa segunda parte, con Edwin Umaña, fue la más dinámica. Durante "60 minutos" siguió un ataque contra Ana, una programadora junior de FINNOVA, una fintech ficticia. Al principio el atacante no hackeó nada, solo investigó (OSINT): encontró una llave de AWS que Ana había borrado del código pero que seguía en el historial de GitHub, su puesto en LinkedIn y el nombre de su perro en Instagram. Su contraseña era Tobi2019.\r\nDe ahí siguió la cadena. Le mandó un phishing con un dominio que imitaba al real letra por letra, usó un InfoStealer de la familia Lumma para robarle las cookies de sesión del navegador, con lo que el MFA ya no sirvió, y probó la técnica ClickFix, un captcha falso que pide pegar un comando con Win+R. Con el acceso, el atacante se movió por la red, se llevó 4,000 registros de clientes y terminó ejecutando un ransomware. Edwin dijo que en promedio un atacante tarda 29 minutos en saltar de una computadora al resto de la red, y que el récord es de 27 segundos.\r\nEn medio de la demo nos pidió levantar la mano si alguna vez habíamos usado la misma contraseña en dos cuentas, subido un .env a GitHub o escaneado un QR sin ver a dónde llevaba. También hizo dinámicas para identificar correos maliciosos y otras señales sospechosas, y fueron los únicos ponentes de la semana que dieron premios por participar, y buenos. A Yanira le quedó el remordimiento de no haberse animado a responder.\r\nPara el uso de IA en el trabajo mostró un semáforo. En verde, dudas generales, algoritmos genéricos o practicar para un examen. En amarillo, código o documentos del trabajo, solo en una IA aprobada por la empresa y sin datos reales. En rojo, nunca: contraseñas, llaves de API, credenciales, datos de clientes ni código propietario. Recomendó usar frases como contraseña, por ejemplo "mi perro Tobi come pupusas en un volcán", que según la demo tardaría más de 2,000 años en romperse, y apoyarse en gestores de contraseñas y passkeys.\r\n\r\nReflexión: Fue la charla que más nos hizo revisar nuestros propios hábitos. Como estudiantes de sistemas subimos proyectos a GitHub y usamos IA a diario, y no siempre pensamos en lo que dejamos expuesto. Desde ese día revisamos mejor lo que va en cada commit y nos tomamos más en serio el MFA. Para Yanira era la primera vez que escuchaba de ESET, y a los dos nos gustó que Edwin cerrara recordando que el mundo necesita gente que sepa defender, con áreas como analista SOC, threat hunting, pentesting, DevSecOps y análisis de malware.	posts/RT9uZbQCixTzKZrudHPMCubYpc5MLd1er4TRIqWm.jpg	publicado	2026-11-21 12:32:51	2026-11-21 12:32:51	2026-11-21 12:32:51	1	1	7
7	BINGO!	bingo	2026-11-18	El miércoles jugamos bingo en el auditorio desde el celular, en una plataforma web con 31 jugadores conectados a la misma sala. Hubo varias partidas, premios en el escenario y un buen rato de convivencia después de dos días de charlas.	Con las ponencias y el taller terminados, el miércoles empezaron las jornadas de desafíos y la mañana fue para el bingo en el auditorio. No fue un bingo de cartón y frijolitos: se jugó en una plataforma web (bingo.fmoues.com) desde el celular. Cada uno entró a una sala con un código, en nuestro caso la 8SX7R, y en la pantalla vimos que había 31 jugadores conectados mientras esperábamos que el administrador iniciara la partida.\r\nDinámica: en el celular a cada quien le aparecía su cartón con las letras B, I, N, G, O, y en la pantalla grande del auditorio se proyectaban el número actual, los números ya llamados y el patrón que había que completar para ganar. Cuando alguien completaba el patrón, presionaba el botón de ¡BINGO! y en la pantalla salía el nombre del ganador con su cartón. Se jugaron varias partidas y pasaron al frente ganadores como Guandique, Benjamín Sánchez y Julio a recoger sus premios.\r\nExperiencia y participación: jugamos con nuestro propio cartón desde el celular. El auditorio estaba lleno y había tensión cada vez que cantaban un número. Yanira no había participado en el bingo en Semanas de Sistemas anteriores, así que esta vez se sumó con ganas. Lo malo fue que, ya cerca del final, a ella y a sus compañeros de año los llamaron a una supuesta reunión que nunca empezó, y se perdieron la ronda del premio mayor.\r\n\r\nReflexión: Fue un buen descanso después de dos días de charlas técnicas y nos permitió convivir con compañeros de otros años. Como estudiantes de sistemas, también nos quedamos pensando en cómo se sincronizan los números en tantos celulares a la vez, porque el sistema funcionó en tiempo real para todo el auditorio sin trabarse.	posts/xO8tzRs11LuN8r48OvbJExmYRt1aPpJh8fNw2xyp.jpg	publicado	2026-11-21 13:00:30	2026-11-21 13:00:30	2026-11-21 13:00:53	1	3	9
8	Expo Systems 2026	expo-systems-2026	2026-11-19	Recorrimos la Expo Systems en la plaza de la facultad y platicamos con los equipos. Vimos una bolsa de trabajo para egresados, un sistema para un comedor, una app para reportar baches, proyectos con Arduino y varios juegos.	El jueves la plaza de la facultad se llenó de stands para la Expo Systems, donde se exponen los proyectos que los docentes seleccionaron antes. Recorrimos la feria y platicamos con los equipos que presentaban. Estos son los proyectos que visitamos:\r\nSeguimiento de egresados y bolsa de trabajo UES. Lo hicieron compañeros de cuarto año pensando en la universidad. Centraliza las vacantes para egresados y graduados: los egresados registran su perfil, los docentes pueden recomendarlos o contactarlos con ofertas de empleo, y los coordinadores tienen en un solo lugar el registro de todos. Tiene un panel institucional con estadísticas por carrera. Tecnologías: Laravel 12, PostgreSQL, Docker, Railway para el despliegue y Brevo para los correos.\r\nSGCO-Chayito. Sistema de gestión contable y operativa para un comedor. Unifica la caja, las comandas por mesa, el inventario con recetas, una pantalla de cocina en tiempo real, el cálculo del IVA del 13 % y la exportación de reportes a Excel. Tecnologías: Laravel, PHP, MySQL y Docker.\r\nReporte Ciudadano. Aplicación Android nativa para reportar baches, fugas o problemas de alumbrado con dos toques sobre el mapa, al estilo de Waze. Los vecinos cercanos confirman los reportes y el caso se cierra cuando el 70 % de los votos concuerda. Usa una API en Laravel 12, Firebase para el inicio de sesión con Google y las notificaciones, y mapas de Mapbox.\r\nProyectos con Arduino. Vimos un velocímetro inteligente montado en una bicicleta, con pantalla LCD y luces que indican estado normal, advertencia o peligro, además de un anemómetro con veleta, un sistema de monitoreo de deslizamientos y un monitor solar. Todos usaban sensores conectados a placas Arduino y mostraban las lecturas en vivo.\r\nOtros proyectos. Basta App Online, el juego de "Basta" (el clásico bachillerato stop) en línea para hasta ocho jugadores por sala, hecho con Java y Firebase. Fue el que más atrapó a Yanira: se quedó un buen rato jugando para intentar ganar un premio. Blink Care+, una app con lectura de documentos por OCR, reconocimiento de objetos y un botón para contactar a un voluntario, pensada para pedir ayuda "en 3 clics". Club Collector, una plataforma de fútbol con álbum de figuritas, predicciones de partidos con monedas virtuales y un minijuego de penales contra la computadora. También pasamos por un blog académico de Teoría de Sistemas.\r\n\r\nInnovación y reflexión: lo que más nos llamó la atención fue que casi todos los proyectos resolvían algo cercano, como un comedor, los baches de la colonia o la búsqueda de empleo de los egresados. También vimos que Laravel aparece en varios proyectos, igual que en el blog que estamos haciendo nosotros, y nos llevamos ideas para desplegar y mejorar el nuestro.	posts/eyGoNBlZUhTHkq6cqAigcINZMo31ysPwaM3k59Wx.jpg	publicado	2026-11-21 13:05:14	2026-11-21 13:05:14	2026-11-21 13:05:14	1	4	10
9	Comelona de Pizza!	comelona-de-pizza	2026-11-19	Al cierre de la Expo Systems se hizo la comelona de pizza bajo los toldos de la plaza. El público no paró de animar y el ganador fue el Ing. Guandique, que se comía dos porciones a la vez	Al mediodía del jueves, justo al cierre de la Expo Systems, se hizo la comelona de pizza bajo los canopis de la plaza. Pusieron una mesa larga con varias cajas de pizza y los participantes se sentaron frente a la suya esperando la señal para empezar.\r\n\r\nDesarrollo: cuando dieron la salida, cada participante tenía que terminarse su pizza lo más rápido posible. Alrededor se juntó un montón de estudiantes que gritaban y animaban a sus compañeros, y muchos grababan con el celular. La sorpresa, y las risas, se las llevó el Ing. Guandique, docente de la carrera de Ingeniería de Sistemas Informáticos, que ganó comiéndose dos porciones de pizza a la vez. Al final se entregaron trofeos a los ganadores frente al arco decorado de la Expo Systems.\r\nConvivencia y experiencia: estuvimos entre el público y fue de los momentos más divertidos de la semana. Se notaba el compañerismo: gente de distintos años apoyando a quien estuviera comiendo, aunque no lo conocieran.\r\n\r\nReflexión: Actividades así hacen que la Semana de Sistemas no sea solo académica. Ver a un docente compitiendo junto a los estudiantes nos dejó claro que compartir algo tan sencillo como una pizza también une a la carrera.	posts/nF9ax8KNeO56Uo6QXzPn1pKoe9OGAZRALGrwDpvz.jpg	publicado	2026-11-21 13:09:35	2026-11-21 13:09:35	2026-11-21 13:09:35	1	5	11
10	Torneo de Futbol Sala	torneo-de-futbol-sala	2026-11-20	\N	La mañana del viernes se dio lugar al torneo de futsal en el cual participaron varios estudiantes de diferentes carreras. Los equipos que participaron en este torneo fueron "Junta Directiva", "Legion 7", "Token FC", "Industrial", "Jefrey y sus amigos", "Docker compose.yml" y "City Rojo". El torneo se desarrollo a eliminación directa con 20 minutos de cada partida con cambio de portería a los 10 minutos del partido, al haber participado 7 equipos el equipo "Junta Directiva" pasaría directamente a la semifinal.\r\nLos encuentros que se dieron en los cuartos fueron: "Legion 7" vs "Token FC", Industrial" vs "Jefrey y sus amigos" y "Docker compose.yml" vs "City Rojo".\r\n\r\nLos equipos que clasificaron para las semifinales fueron "Junta Directiva", "Legion 7", "Jefrey y sus amigos" y "City Rojo", posteriormente esto equipo se enfrentarian entre ellos para ver quienes llegarían a la final, primero se enfrentó "Legion 7" vs "Junta Directiva" en el cual saldría victorioso el equipo de "Junta Directiva" y el segundo partido que se dio fue "City Rojo" vs "Jefrey y sus amigos" en el cual quedaría ganador "Jefrey y sus amigos".\r\nLa final se disputo después de 20 minutos de receso para los equipos finalistas los cuales fueron "Junta Directiva" y "Jefrey y sus amigos", este encuentro estuvo bastante reñido pero el equipo de Jefrey se impondría ante los de Junta Directiva consiguiendo la victorioso y así "Jefrey y sus amigos" quedarían campeones de este torneo y obteniendo la copa del torneo.	posts/ApceYfbzjiADL8vOYdiWGpvo8LyVjubmHKTdmqel.jpg	publicado	2026-11-21 13:23:06	2026-11-21 13:23:06	2026-11-21 13:23:06	1	6	12
11	Parrillada de cierre de la Semana de Sistemas 2026	parrillada-de-cierre-de-la-semana-de-sistemas-2026	2026-11-20	\N	Depues del desarrollo del torneo se hicieron la entrega de la parrillada como cierre de la Semana de Sistemas 2026 el cual serveria como un momento para disfrutar de la buena comida y la convivencia con los compañeros.	posts/jVSj7tmSty23WtEJzak6PjFUWiZIE8i1zxRPUsVI.jpg	publicado	2026-11-21 13:25:52	2026-11-21 13:25:52	2026-11-21 13:25:52	1	7	13
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, name, carnet, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
2	Yanira Verenice Martínez Aguilar	MA22013	ma22013@ues.edu.sv	\N	$2y$12$UruOWq21WJPd0ANeBPDnTeKvNTTe5Lenc2nasZRciBIaZk0mDkJn6	\N	2026-11-21 00:00:31	2026-11-21 11:37:57
3	Admin	AA00000	admin@ues.edu.sv	\N	$2y$12$wIZ840aOaPNsSFl4QavTLOjhKtV/YqlT27kHSuFogHaMNIrTrD0au	gIwSRO9GYJYSutexbvnmxI5QGzZ3qLTGj2X9MWVn5a45qzkuknB42leRmncr	2026-11-21 10:26:09	2026-11-21 11:37:57
1	Jairo Alexander Argueta Alvarenga	AA23027	aa23027@ues.edu.sv	\N	$2y$12$HI/eySiB/RxmoRQH3jo7zelsHsYloykNSRoG2RVzX6FR/x6Nwji3y	PuZCKQuOOzRnz81rPqg2h3GY30NUATiVRP3tpgZkjUZYLdrYigqaBcSh33n4	2026-11-21 00:00:31	2026-11-21 11:37:57
\.


--
-- Name: actividades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.actividades_id_seq', 13, true);


--
-- Name: categorias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.categorias_id_seq', 13, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 28, true);


--
-- Name: post_images_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.post_images_id_seq', 72, true);


--
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.posts_id_seq', 11, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 3, true);


--
-- Name: actividades actividades_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.actividades
    ADD CONSTRAINT actividades_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: categorias categorias_nombre_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_nombre_unique UNIQUE (nombre);


--
-- Name: categorias categorias_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id);


--
-- Name: categorias categorias_slug_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_slug_unique UNIQUE (slug);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: post_images post_images_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.post_images
    ADD CONSTRAINT post_images_pkey PRIMARY KEY (id);


--
-- Name: post_user post_user_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.post_user
    ADD CONSTRAINT post_user_pkey PRIMARY KEY (post_id, usuario_id);


--
-- Name: posts posts_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);


--
-- Name: posts posts_slug_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_slug_unique UNIQUE (slug);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_carnet_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_carnet_unique UNIQUE (carnet);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: posts_estado_publicado_en_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX posts_estado_publicado_en_index ON public.posts USING btree (estado, publicado_en);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: actividades actividades_categoria_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.actividades
    ADD CONSTRAINT actividades_categoria_id_foreign FOREIGN KEY (categoria_id) REFERENCES public.categorias(id) ON DELETE RESTRICT;


--
-- Name: post_images post_images_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.post_images
    ADD CONSTRAINT post_images_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: post_images post_images_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.post_images
    ADD CONSTRAINT post_images_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: post_user post_user_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.post_user
    ADD CONSTRAINT post_user_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: post_user post_user_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.post_user
    ADD CONSTRAINT post_user_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: posts posts_actividad_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_actividad_id_foreign FOREIGN KEY (actividad_id) REFERENCES public.actividades(id) ON DELETE SET NULL;


--
-- Name: posts posts_categoria_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_categoria_id_foreign FOREIGN KEY (categoria_id) REFERENCES public.categorias(id) ON DELETE RESTRICT;


--
-- Name: posts posts_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id) ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

\unrestrict yldtJ3X56pIH9lVe0g0bm56tAuxSSUJjpIBIxpAZ9bK9TG85gtg0gNXu52XqLU3

