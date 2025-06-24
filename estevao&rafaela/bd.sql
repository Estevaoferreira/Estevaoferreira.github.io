-- project url - https://evtmospgeteaonjcuxyt.supabase.co
-- annon public - eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImV2dG1vc3BnZXRlYW9uamN1eHl0Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTA3ODQzODEsImV4cCI6MjA2NjM2MDM4MX0.c0y3-QBmVGWv5wwysMO79iKGk4WI_DbR238SgU5ac9o
-- service role secret - eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImV2dG1vc3BnZXRlYW9uamN1eHl0Iiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc1MDc4NDM4MSwiZXhwIjoyMDY2MzYwMzgxfQ.ww8djUFjxvTmzZdtKc5PDaxWQlR38D88NOZnBItAC5I


-- Cria a função para decrementar a contagem de lugares disponíveis
-- Recebe a quantidade de lugares a serem reservados
CREATE OR REPLACE FUNCTION decrement_available_spots(amount integer)
RETURNS integer AS $$
DECLARE
    new_count integer;
BEGIN
    -- Atualiza a contagem na tabela settings
    UPDATE settings
    SET available_spots = available_spots - amount
    WHERE id = 1
    RETURNING available_spots INTO new_count; -- Retorna o novo valor

    -- Opcional: Adicionar validação para não permitir contagem negativa
    -- IF new_count < 0 THEN
    --     RAISE EXCEPTION 'Não há lugares suficientes disponíveis.';
    -- END IF;

    RETURN new_count; -- Retorna a contagem atualizada
END;
$$ LANGUAGE plpgsql;

-- Concede permissão de execução para o papel 'anon' (usuários não autenticados)
GRANT EXECUTE ON FUNCTION decrement_available_spots(integer) TO anon;





---CREATE TABLEA

-- Tabela para armazenar configurações globais, como a contagem de lugares disponíveis
CREATE TABLE public.settings (
    id integer NOT NULL DEFAULT 1, -- Usaremos sempre o ID 1 para a única linha de configurações
    available_spots integer NOT NULL, -- Número de lugares disponíveis
    created_at timestamp with time zone DEFAULT now() NOT NULL,
    updated_at timestamp with time zone DEFAULT now() NOT NULL,

    CONSTRAINT settings_pkey PRIMARY KEY (id) -- Garante que só pode haver uma linha com id = 1
);

-- Adiciona um índice para a coluna updated_at (opcional, mas boa prática)
CREATE INDEX settings_updated_at_idx ON public.settings USING btree (updated_at);

-- Configura a atualização automática da coluna updated_at
CREATE TRIGGER handle_updated_at BEFORE UPDATE ON public.settings
  FOR EACH ROW EXECUTE FUNCTION moddatetime('updated_at');


-- Tabela para armazenar as reservas individuais
CREATE TABLE public.reservations (
    id uuid NOT NULL DEFAULT gen_random_uuid(), -- ID único para cada reserva
    name text NOT NULL, -- Nome da pessoa principal que fez a reserva
    quantity integer NOT NULL, -- Quantidade total de pessoas na reserva
    email text, -- E-mail para contato (opcional)
    guest_names jsonb, -- Array JSONB para armazenar todos os nomes (principal + convidados)
    created_at timestamp with time zone DEFAULT now() NOT NULL,

    CONSTRAINT reservations_pkey PRIMARY KEY (id) -- Define o ID como chave primária
);

-- Adiciona um índice para a coluna created_at (opcional, mas boa prática)
CREATE INDEX reservations_created_at_idx ON public.reservations USING btree (created_at);





-- depoois

    INSERT INTO public.settings (id, available_spots)
    VALUES (1, 118) -- Substitua 118 pelo número inicial de lugares
    ON CONFLICT (id) DO NOTHING; -- Evita erro se a linha já existir
