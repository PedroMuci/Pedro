PGDMP  +                    }            teste002    16.3    16.3 >                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    35330    teste002    DATABASE        CREATE DATABASE teste002 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE teste002;
                postgres    false            �            1255    35455    atualiza_data()    FUNCTION     �   CREATE FUNCTION public.atualiza_data() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
   NEW.atualizado_em = CURRENT_TIMESTAMP;
   RETURN NEW;
END;
$$;
 &   DROP FUNCTION public.atualiza_data();
       public          postgres    false            �            1259    35436 	   avaliacao    TABLE     �   CREATE TABLE public.avaliacao (
    id integer NOT NULL,
    postagem_id integer NOT NULL,
    conta_id integer NOT NULL,
    nota integer,
    CONSTRAINT avaliacao_nota_check CHECK (((nota >= 0) AND (nota <= 10)))
);
    DROP TABLE public.avaliacao;
       public         heap    postgres    false            �            1259    35435    avaliacao_id_seq    SEQUENCE     �   CREATE SEQUENCE public.avaliacao_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.avaliacao_id_seq;
       public          postgres    false    227                       0    0    avaliacao_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.avaliacao_id_seq OWNED BY public.avaliacao.id;
          public          postgres    false    226            �            1259    35365    conta    TABLE     �   CREATE TABLE public.conta (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    senha character varying(255) NOT NULL,
    tipo_conta_id integer NOT NULL
);
    DROP TABLE public.conta;
       public         heap    postgres    false            �            1259    35364    conta_id_seq    SEQUENCE     �   CREATE SEQUENCE public.conta_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.conta_id_seq;
       public          postgres    false    218                       0    0    conta_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.conta_id_seq OWNED BY public.conta.id;
          public          postgres    false    217            �            1259    35421    feedback_devolucao    TABLE     �   CREATE TABLE public.feedback_devolucao (
    id integer NOT NULL,
    postagem_id integer NOT NULL,
    mensagem text NOT NULL,
    criado_em timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
 &   DROP TABLE public.feedback_devolucao;
       public         heap    postgres    false            �            1259    35420    feedback_devolucao_id_seq    SEQUENCE     �   CREATE SEQUENCE public.feedback_devolucao_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.feedback_devolucao_id_seq;
       public          postgres    false    225                       0    0    feedback_devolucao_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.feedback_devolucao_id_seq OWNED BY public.feedback_devolucao.id;
          public          postgres    false    224            �            1259    35397    palavra_chave    TABLE     j   CREATE TABLE public.palavra_chave (
    id integer NOT NULL,
    texto character varying(100) NOT NULL
);
 !   DROP TABLE public.palavra_chave;
       public         heap    postgres    false            �            1259    35396    palavra_chave_id_seq    SEQUENCE     �   CREATE SEQUENCE public.palavra_chave_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.palavra_chave_id_seq;
       public          postgres    false    222                       0    0    palavra_chave_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.palavra_chave_id_seq OWNED BY public.palavra_chave.id;
          public          postgres    false    221            �            1259    35379    postagem    TABLE       CREATE TABLE public.postagem (
    id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    texto text NOT NULL,
    imagem_1 text NOT NULL,
    imagem_2 text,
    imagem_3 text,
    video text,
    musica text,
    fonte text NOT NULL,
    status character varying(30) DEFAULT 'pendente'::character varying NOT NULL,
    nota numeric(3,1) DEFAULT 0,
    conta_id integer NOT NULL,
    criado_em timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    atualizado_em timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.postagem;
       public         heap    postgres    false            �            1259    35378    postagem_id_seq    SEQUENCE     �   CREATE SEQUENCE public.postagem_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.postagem_id_seq;
       public          postgres    false    220                       0    0    postagem_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.postagem_id_seq OWNED BY public.postagem.id;
          public          postgres    false    219            �            1259    35405    postagem_palavra_chave    TABLE     x   CREATE TABLE public.postagem_palavra_chave (
    postagem_id integer NOT NULL,
    palavra_chave_id integer NOT NULL
);
 *   DROP TABLE public.postagem_palavra_chave;
       public         heap    postgres    false            �            1259    35356 
   tipo_conta    TABLE     e   CREATE TABLE public.tipo_conta (
    id integer NOT NULL,
    nome character varying(50) NOT NULL
);
    DROP TABLE public.tipo_conta;
       public         heap    postgres    false            �            1259    35355    tipo_conta_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_conta_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.tipo_conta_id_seq;
       public          postgres    false    216            	           0    0    tipo_conta_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.tipo_conta_id_seq OWNED BY public.tipo_conta.id;
          public          postgres    false    215            B           2604    35439    avaliacao id    DEFAULT     l   ALTER TABLE ONLY public.avaliacao ALTER COLUMN id SET DEFAULT nextval('public.avaliacao_id_seq'::regclass);
 ;   ALTER TABLE public.avaliacao ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    226    227            9           2604    35368    conta id    DEFAULT     d   ALTER TABLE ONLY public.conta ALTER COLUMN id SET DEFAULT nextval('public.conta_id_seq'::regclass);
 7   ALTER TABLE public.conta ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218            @           2604    35424    feedback_devolucao id    DEFAULT     ~   ALTER TABLE ONLY public.feedback_devolucao ALTER COLUMN id SET DEFAULT nextval('public.feedback_devolucao_id_seq'::regclass);
 D   ALTER TABLE public.feedback_devolucao ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    224    225    225            ?           2604    35400    palavra_chave id    DEFAULT     t   ALTER TABLE ONLY public.palavra_chave ALTER COLUMN id SET DEFAULT nextval('public.palavra_chave_id_seq'::regclass);
 ?   ALTER TABLE public.palavra_chave ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    222    222            :           2604    35382    postagem id    DEFAULT     j   ALTER TABLE ONLY public.postagem ALTER COLUMN id SET DEFAULT nextval('public.postagem_id_seq'::regclass);
 :   ALTER TABLE public.postagem ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    220    220            8           2604    35359    tipo_conta id    DEFAULT     n   ALTER TABLE ONLY public.tipo_conta ALTER COLUMN id SET DEFAULT nextval('public.tipo_conta_id_seq'::regclass);
 <   ALTER TABLE public.tipo_conta ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            �          0    35436 	   avaliacao 
   TABLE DATA           D   COPY public.avaliacao (id, postagem_id, conta_id, nota) FROM stdin;
    public          postgres    false    227   EK       �          0    35365    conta 
   TABLE DATA           F   COPY public.conta (id, nome, email, senha, tipo_conta_id) FROM stdin;
    public          postgres    false    218   bK       �          0    35421    feedback_devolucao 
   TABLE DATA           R   COPY public.feedback_devolucao (id, postagem_id, mensagem, criado_em) FROM stdin;
    public          postgres    false    225   K       �          0    35397    palavra_chave 
   TABLE DATA           2   COPY public.palavra_chave (id, texto) FROM stdin;
    public          postgres    false    222   �K       �          0    35379    postagem 
   TABLE DATA           �   COPY public.postagem (id, titulo, texto, imagem_1, imagem_2, imagem_3, video, musica, fonte, status, nota, conta_id, criado_em, atualizado_em) FROM stdin;
    public          postgres    false    220   �K       �          0    35405    postagem_palavra_chave 
   TABLE DATA           O   COPY public.postagem_palavra_chave (postagem_id, palavra_chave_id) FROM stdin;
    public          postgres    false    223   �K       �          0    35356 
   tipo_conta 
   TABLE DATA           .   COPY public.tipo_conta (id, nome) FROM stdin;
    public          postgres    false    216   �K       
           0    0    avaliacao_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.avaliacao_id_seq', 1, false);
          public          postgres    false    226                       0    0    conta_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.conta_id_seq', 1, false);
          public          postgres    false    217                       0    0    feedback_devolucao_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.feedback_devolucao_id_seq', 1, false);
          public          postgres    false    224                       0    0    palavra_chave_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.palavra_chave_id_seq', 1, false);
          public          postgres    false    221                       0    0    postagem_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.postagem_id_seq', 1, false);
          public          postgres    false    219                       0    0    tipo_conta_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.tipo_conta_id_seq', 3, true);
          public          postgres    false    215            W           2606    35442    avaliacao avaliacao_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.avaliacao
    ADD CONSTRAINT avaliacao_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.avaliacao DROP CONSTRAINT avaliacao_pkey;
       public            postgres    false    227            Y           2606    35444 ,   avaliacao avaliacao_postagem_id_conta_id_key 
   CONSTRAINT     x   ALTER TABLE ONLY public.avaliacao
    ADD CONSTRAINT avaliacao_postagem_id_conta_id_key UNIQUE (postagem_id, conta_id);
 V   ALTER TABLE ONLY public.avaliacao DROP CONSTRAINT avaliacao_postagem_id_conta_id_key;
       public            postgres    false    227    227            I           2606    35372    conta conta_email_key 
   CONSTRAINT     Q   ALTER TABLE ONLY public.conta
    ADD CONSTRAINT conta_email_key UNIQUE (email);
 ?   ALTER TABLE ONLY public.conta DROP CONSTRAINT conta_email_key;
       public            postgres    false    218            K           2606    35370    conta conta_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.conta
    ADD CONSTRAINT conta_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.conta DROP CONSTRAINT conta_pkey;
       public            postgres    false    218            U           2606    35429 *   feedback_devolucao feedback_devolucao_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.feedback_devolucao
    ADD CONSTRAINT feedback_devolucao_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.feedback_devolucao DROP CONSTRAINT feedback_devolucao_pkey;
       public            postgres    false    225            O           2606    35402     palavra_chave palavra_chave_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.palavra_chave
    ADD CONSTRAINT palavra_chave_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.palavra_chave DROP CONSTRAINT palavra_chave_pkey;
       public            postgres    false    222            Q           2606    35404 %   palavra_chave palavra_chave_texto_key 
   CONSTRAINT     a   ALTER TABLE ONLY public.palavra_chave
    ADD CONSTRAINT palavra_chave_texto_key UNIQUE (texto);
 O   ALTER TABLE ONLY public.palavra_chave DROP CONSTRAINT palavra_chave_texto_key;
       public            postgres    false    222            S           2606    35409 2   postagem_palavra_chave postagem_palavra_chave_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.postagem_palavra_chave
    ADD CONSTRAINT postagem_palavra_chave_pkey PRIMARY KEY (postagem_id, palavra_chave_id);
 \   ALTER TABLE ONLY public.postagem_palavra_chave DROP CONSTRAINT postagem_palavra_chave_pkey;
       public            postgres    false    223    223            M           2606    35390    postagem postagem_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.postagem
    ADD CONSTRAINT postagem_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.postagem DROP CONSTRAINT postagem_pkey;
       public            postgres    false    220            E           2606    35363    tipo_conta tipo_conta_nome_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.tipo_conta
    ADD CONSTRAINT tipo_conta_nome_key UNIQUE (nome);
 H   ALTER TABLE ONLY public.tipo_conta DROP CONSTRAINT tipo_conta_nome_key;
       public            postgres    false    216            G           2606    35361    tipo_conta tipo_conta_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.tipo_conta
    ADD CONSTRAINT tipo_conta_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.tipo_conta DROP CONSTRAINT tipo_conta_pkey;
       public            postgres    false    216            a           2620    35456    postagem atualiza_postagem    TRIGGER     x   CREATE TRIGGER atualiza_postagem BEFORE UPDATE ON public.postagem FOR EACH ROW EXECUTE FUNCTION public.atualiza_data();
 3   DROP TRIGGER atualiza_postagem ON public.postagem;
       public          postgres    false    228    220            _           2606    35450 !   avaliacao avaliacao_conta_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.avaliacao
    ADD CONSTRAINT avaliacao_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES public.conta(id) ON DELETE CASCADE;
 K   ALTER TABLE ONLY public.avaliacao DROP CONSTRAINT avaliacao_conta_id_fkey;
       public          postgres    false    218    227    4683            `           2606    35445 $   avaliacao avaliacao_postagem_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.avaliacao
    ADD CONSTRAINT avaliacao_postagem_id_fkey FOREIGN KEY (postagem_id) REFERENCES public.postagem(id) ON DELETE CASCADE;
 N   ALTER TABLE ONLY public.avaliacao DROP CONSTRAINT avaliacao_postagem_id_fkey;
       public          postgres    false    4685    227    220            Z           2606    35373    conta conta_tipo_conta_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.conta
    ADD CONSTRAINT conta_tipo_conta_id_fkey FOREIGN KEY (tipo_conta_id) REFERENCES public.tipo_conta(id) ON UPDATE CASCADE ON DELETE RESTRICT;
 H   ALTER TABLE ONLY public.conta DROP CONSTRAINT conta_tipo_conta_id_fkey;
       public          postgres    false    216    218    4679            ^           2606    35430 6   feedback_devolucao feedback_devolucao_postagem_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.feedback_devolucao
    ADD CONSTRAINT feedback_devolucao_postagem_id_fkey FOREIGN KEY (postagem_id) REFERENCES public.postagem(id) ON UPDATE CASCADE ON DELETE CASCADE;
 `   ALTER TABLE ONLY public.feedback_devolucao DROP CONSTRAINT feedback_devolucao_postagem_id_fkey;
       public          postgres    false    4685    220    225            [           2606    35391    postagem postagem_conta_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.postagem
    ADD CONSTRAINT postagem_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES public.conta(id) ON UPDATE CASCADE ON DELETE CASCADE;
 I   ALTER TABLE ONLY public.postagem DROP CONSTRAINT postagem_conta_id_fkey;
       public          postgres    false    220    218    4683            \           2606    35415 C   postagem_palavra_chave postagem_palavra_chave_palavra_chave_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.postagem_palavra_chave
    ADD CONSTRAINT postagem_palavra_chave_palavra_chave_id_fkey FOREIGN KEY (palavra_chave_id) REFERENCES public.palavra_chave(id) ON DELETE CASCADE;
 m   ALTER TABLE ONLY public.postagem_palavra_chave DROP CONSTRAINT postagem_palavra_chave_palavra_chave_id_fkey;
       public          postgres    false    4687    223    222            ]           2606    35410 >   postagem_palavra_chave postagem_palavra_chave_postagem_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.postagem_palavra_chave
    ADD CONSTRAINT postagem_palavra_chave_postagem_id_fkey FOREIGN KEY (postagem_id) REFERENCES public.postagem(id) ON DELETE CASCADE;
 h   ALTER TABLE ONLY public.postagem_palavra_chave DROP CONSTRAINT postagem_palavra_chave_postagem_id_fkey;
       public          postgres    false    220    223    4685            �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �   +   x�3��I�,�/�2�L.�LL��9Sr3�2�K���=... U\     