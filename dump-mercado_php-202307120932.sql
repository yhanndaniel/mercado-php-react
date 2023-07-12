--
-- PostgreSQL database cluster dump
--

-- Started on 2023-07-12 09:32:01 -03

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Roles
--

CREATE ROLE postgres;
ALTER ROLE postgres WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS;

--
-- User Configurations
--








--
-- Databases
--

--
-- Database "template1" dump
--

\connect template1

--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3 (Debian 15.3-1.pgdg120+1)
-- Dumped by pg_dump version 15.3

-- Started on 2023-07-12 09:32:01 -03

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

-- Completed on 2023-07-12 09:32:01 -03

--
-- PostgreSQL database dump complete
--

--
-- Database "mercado_php" dump
--

--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3 (Debian 15.3-1.pgdg120+1)
-- Dumped by pg_dump version 15.3

-- Started on 2023-07-12 09:32:01 -03

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3382 (class 1262 OID 16482)
-- Name: mercado_php; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE mercado_php WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';


ALTER DATABASE mercado_php OWNER TO postgres;

\connect mercado_php

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
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
-- TOC entry 220 (class 1259 OID 16556)
-- Name: cart_products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cart_products (
    products_id integer NOT NULL,
    cart_id integer NOT NULL,
    quantity integer NOT NULL,
    total_amount numeric(8,2) NOT NULL,
    total_tax numeric(8,2) NOT NULL,
    total numeric(8,2) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.cart_products OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 16528)
-- Name: product_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_types (
    id integer NOT NULL,
    name character varying(45) NOT NULL,
    description character varying(45),
    tax numeric(8,2) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.product_types OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16527)
-- Name: product_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_types_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_types_id_seq OWNER TO postgres;

--
-- TOC entry 3383 (class 0 OID 0)
-- Dependencies: 214
-- Name: product_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.product_types_id_seq OWNED BY public.product_types.id;


--
-- TOC entry 217 (class 1259 OID 16535)
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id integer NOT NULL,
    product_types_id integer NOT NULL,
    name character varying(255) NOT NULL,
    price numeric(8,2) NOT NULL,
    description character varying(255),
    image character varying(255),
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.products OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16534)
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_id_seq OWNER TO postgres;

--
-- TOC entry 3384 (class 0 OID 0)
-- Dependencies: 216
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- TOC entry 219 (class 1259 OID 16549)
-- Name: sales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sales (
    id integer NOT NULL,
    total_amount numeric(8,2) NOT NULL,
    total_tax numeric(8,2) NOT NULL,
    total numeric(8,2) NOT NULL,
    saled smallint DEFAULT 0 NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.sales OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 16548)
-- Name: sales_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sales_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sales_id_seq OWNER TO postgres;

--
-- TOC entry 3385 (class 0 OID 0)
-- Dependencies: 218
-- Name: sales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sales_id_seq OWNED BY public.sales.id;


--
-- TOC entry 3213 (class 2604 OID 16531)
-- Name: product_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_types ALTER COLUMN id SET DEFAULT nextval('public.product_types_id_seq'::regclass);


--
-- TOC entry 3214 (class 2604 OID 16538)
-- Name: products id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- TOC entry 3215 (class 2604 OID 16552)
-- Name: sales id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales ALTER COLUMN id SET DEFAULT nextval('public.sales_id_seq'::regclass);


--
-- TOC entry 3376 (class 0 OID 16556)
-- Dependencies: 220
-- Data for Name: cart_products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cart_products (products_id, cart_id, quantity, total_amount, total_tax, total, created_at, updated_at) FROM stdin;
4	22	2	10000.00	1500.00	11500.00	2023-07-12 08:51:26	2023-07-12 08:51:26
5	22	1	20.00	6.00	26.00	2023-07-12 08:51:26	2023-07-12 08:51:26
7	22	1	10.00	3.00	13.00	2023-07-12 08:51:26	2023-07-12 08:51:26
6	22	1	12000.00	1800.00	13800.00	2023-07-12 08:51:27	2023-07-12 08:51:27
6	23	1	12000.00	1800.00	13800.00	2023-07-12 08:55:41	2023-07-12 08:55:41
4	23	1	5000.00	750.00	5750.00	2023-07-12 08:55:41	2023-07-12 08:55:41
\.


--
-- TOC entry 3371 (class 0 OID 16528)
-- Dependencies: 215
-- Data for Name: product_types; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product_types (id, name, description, tax, created_at, updated_at) FROM stdin;
13	Eletronico	Produtos Eletronicos	15.00	2023-07-12 08:46:13	2023-07-12 08:46:13
14	Bebidas	Bebias	30.00	2023-07-12 08:46:36	2023-07-12 08:46:36
\.


--
-- TOC entry 3373 (class 0 OID 16535)
-- Dependencies: 217
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, product_types_id, name, price, description, image, created_at, updated_at) FROM stdin;
4	13	Iphone	5000.00	Celular 	\N	2023-07-12 08:47:01	2023-07-12 08:47:01
5	14	Cerveja Original	20.00	Bebida Alcolica	\N	2023-07-12 08:47:52	2023-07-12 08:47:52
6	13	MacBook	12000.00	Computador	\N	2023-07-12 08:49:29	2023-07-12 08:49:29
7	14	Coca cola	10.00	Refrigerante	https://placehold.co/236	2023-07-12 08:50:32	2023-07-12 08:50:32
\.


--
-- TOC entry 3375 (class 0 OID 16549)
-- Dependencies: 219
-- Data for Name: sales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sales (id, total_amount, total_tax, total, saled, created_at, updated_at) FROM stdin;
22	22030.00	3309.00	25339.00	1	2023-07-12 08:51:26	2023-07-12 08:51:26
23	17000.00	2550.00	19550.00	1	2023-07-12 08:55:41	2023-07-12 08:55:41
\.


--
-- TOC entry 3386 (class 0 OID 0)
-- Dependencies: 214
-- Name: product_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_types_id_seq', 14, true);


--
-- TOC entry 3387 (class 0 OID 0)
-- Dependencies: 216
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 7, true);


--
-- TOC entry 3388 (class 0 OID 0)
-- Dependencies: 218
-- Name: sales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sales_id_seq', 23, true);


--
-- TOC entry 3224 (class 2606 OID 16560)
-- Name: cart_products cart_products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cart_products
    ADD CONSTRAINT cart_products_pkey PRIMARY KEY (products_id, cart_id);


--
-- TOC entry 3218 (class 2606 OID 16533)
-- Name: product_types product_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_types
    ADD CONSTRAINT product_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3220 (class 2606 OID 16542)
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- TOC entry 3222 (class 2606 OID 16555)
-- Name: sales sales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (id);


--
-- TOC entry 3226 (class 2606 OID 16566)
-- Name: cart_products fk_products_has_cart_cart1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cart_products
    ADD CONSTRAINT fk_products_has_cart_cart1 FOREIGN KEY (cart_id) REFERENCES public.sales(id);


--
-- TOC entry 3227 (class 2606 OID 16561)
-- Name: cart_products fk_products_has_cart_products1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cart_products
    ADD CONSTRAINT fk_products_has_cart_products1 FOREIGN KEY (products_id) REFERENCES public.products(id);


--
-- TOC entry 3225 (class 2606 OID 16543)
-- Name: products fk_products_product_types; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT fk_products_product_types FOREIGN KEY (product_types_id) REFERENCES public.product_types(id);


-- Completed on 2023-07-12 09:32:01 -03

--
-- PostgreSQL database dump complete
--

--
-- Database "postgres" dump
--

\connect postgres

--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3 (Debian 15.3-1.pgdg120+1)
-- Dumped by pg_dump version 15.3

-- Started on 2023-07-12 09:32:01 -03

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
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
-- TOC entry 220 (class 1259 OID 16512)
-- Name: cart_products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cart_products (
    products_id integer NOT NULL,
    cart_id integer NOT NULL,
    quantity integer NOT NULL,
    total_amount numeric(8,2) NOT NULL,
    total_tax numeric(8,2) NOT NULL,
    total numeric(8,2) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.cart_products OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 16484)
-- Name: product_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_types (
    id integer NOT NULL,
    name character varying(45) NOT NULL,
    description character varying(45),
    tax numeric(8,2) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.product_types OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16483)
-- Name: product_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_types_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_types_id_seq OWNER TO postgres;

--
-- TOC entry 3382 (class 0 OID 0)
-- Dependencies: 214
-- Name: product_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.product_types_id_seq OWNED BY public.product_types.id;


--
-- TOC entry 217 (class 1259 OID 16491)
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id integer NOT NULL,
    product_types_id integer NOT NULL,
    name character varying(255) NOT NULL,
    price numeric(8,2) NOT NULL,
    description character varying(255),
    image character varying(255),
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.products OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16490)
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_id_seq OWNER TO postgres;

--
-- TOC entry 3383 (class 0 OID 0)
-- Dependencies: 216
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- TOC entry 219 (class 1259 OID 16505)
-- Name: sales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sales (
    id integer NOT NULL,
    total_amount numeric(8,2) NOT NULL,
    total_tax numeric(8,2) NOT NULL,
    total numeric(8,2) NOT NULL,
    saled smallint DEFAULT 0 NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.sales OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 16504)
-- Name: sales_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sales_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sales_id_seq OWNER TO postgres;

--
-- TOC entry 3384 (class 0 OID 0)
-- Dependencies: 218
-- Name: sales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sales_id_seq OWNED BY public.sales.id;


--
-- TOC entry 3213 (class 2604 OID 16487)
-- Name: product_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_types ALTER COLUMN id SET DEFAULT nextval('public.product_types_id_seq'::regclass);


--
-- TOC entry 3214 (class 2604 OID 16494)
-- Name: products id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- TOC entry 3215 (class 2604 OID 16508)
-- Name: sales id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales ALTER COLUMN id SET DEFAULT nextval('public.sales_id_seq'::regclass);


--
-- TOC entry 3376 (class 0 OID 16512)
-- Dependencies: 220
-- Data for Name: cart_products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cart_products (products_id, cart_id, quantity, total_amount, total_tax, total, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3371 (class 0 OID 16484)
-- Dependencies: 215
-- Data for Name: product_types; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product_types (id, name, description, tax, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3373 (class 0 OID 16491)
-- Dependencies: 217
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, product_types_id, name, price, description, image, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3375 (class 0 OID 16505)
-- Dependencies: 219
-- Data for Name: sales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sales (id, total_amount, total_tax, total, saled, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3385 (class 0 OID 0)
-- Dependencies: 214
-- Name: product_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_types_id_seq', 1, false);


--
-- TOC entry 3386 (class 0 OID 0)
-- Dependencies: 216
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 1, false);


--
-- TOC entry 3387 (class 0 OID 0)
-- Dependencies: 218
-- Name: sales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sales_id_seq', 1, false);


--
-- TOC entry 3224 (class 2606 OID 16516)
-- Name: cart_products cart_products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cart_products
    ADD CONSTRAINT cart_products_pkey PRIMARY KEY (products_id, cart_id);


--
-- TOC entry 3218 (class 2606 OID 16489)
-- Name: product_types product_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_types
    ADD CONSTRAINT product_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3220 (class 2606 OID 16498)
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- TOC entry 3222 (class 2606 OID 16511)
-- Name: sales sales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (id);


--
-- TOC entry 3226 (class 2606 OID 16522)
-- Name: cart_products fk_products_has_cart_cart1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cart_products
    ADD CONSTRAINT fk_products_has_cart_cart1 FOREIGN KEY (cart_id) REFERENCES public.sales(id);


--
-- TOC entry 3227 (class 2606 OID 16517)
-- Name: cart_products fk_products_has_cart_products1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cart_products
    ADD CONSTRAINT fk_products_has_cart_products1 FOREIGN KEY (products_id) REFERENCES public.products(id);


--
-- TOC entry 3225 (class 2606 OID 16499)
-- Name: products fk_products_product_types; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT fk_products_product_types FOREIGN KEY (product_types_id) REFERENCES public.product_types(id);


-- Completed on 2023-07-12 09:32:01 -03

--
-- PostgreSQL database dump complete
--

-- Completed on 2023-07-12 09:32:01 -03

--
-- PostgreSQL database cluster dump complete
--

