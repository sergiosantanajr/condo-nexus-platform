
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card, CardContent, CardHeader, CardTitle, CardDescription, CardFooter } from "@/components/ui/card";
import { toast } from "@/hooks/use-toast";
import { Link } from "react-router-dom";

const PortalCadastro = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    nome: "",
    email: "",
    telefone: "",
    condominio: "",
    unidade: "",
    password: "",
    confirmPassword: "",
  });

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    // Validação básica
    if (!formData.nome || !formData.email || !formData.condominio || !formData.password) {
      toast({
        title: "Erro",
        description: "Por favor, preencha todos os campos obrigatórios",
        variant: "destructive"
      });
      return;
    }

    if (formData.password !== formData.confirmPassword) {
      toast({
        title: "Erro",
        description: "As senhas não conferem",
        variant: "destructive"
      });
      return;
    }

    // Simulando cadastro com sucesso
    toast({
      title: "Cadastro realizado",
      description: "Sua conta foi criada com sucesso!"
    });
    
    setTimeout(() => {
      navigate("/portal");
    }, 1500);
  };

  return (
    <div className="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <Card className="w-full max-w-lg">
        <CardHeader className="text-center">
          <div className="mx-auto mb-4 w-12 h-12 bg-brand-teal rounded-md flex items-center justify-center">
            <span className="text-white font-bold text-xl">NA</span>
          </div>
          <CardTitle className="text-2xl font-bold text-brand-blue">Cadastro de Condômino</CardTitle>
          <CardDescription>
            Preencha os dados para criar sua conta
          </CardDescription>
        </CardHeader>
        <form onSubmit={handleSubmit}>
          <CardContent>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label htmlFor="nome" className="block text-sm font-medium mb-1">
                  Nome Completo*
                </label>
                <Input
                  id="nome"
                  name="nome"
                  value={formData.nome}
                  onChange={handleInputChange}
                  placeholder="Nome completo"
                />
              </div>
              <div>
                <label htmlFor="email" className="block text-sm font-medium mb-1">
                  Email*
                </label>
                <Input
                  id="email"
                  name="email"
                  type="email"
                  value={formData.email}
                  onChange={handleInputChange}
                  placeholder="seu-email@exemplo.com.br"
                />
              </div>
              <div>
                <label htmlFor="telefone" className="block text-sm font-medium mb-1">
                  Telefone
                </label>
                <Input
                  id="telefone"
                  name="telefone"
                  value={formData.telefone}
                  onChange={handleInputChange}
                  placeholder="(00) 00000-0000"
                />
              </div>
              <div>
                <label htmlFor="condominio" className="block text-sm font-medium mb-1">
                  Condomínio*
                </label>
                <Input
                  id="condominio"
                  name="condominio"
                  value={formData.condominio}
                  onChange={handleInputChange}
                  placeholder="Nome do seu condomínio"
                />
              </div>
              <div>
                <label htmlFor="unidade" className="block text-sm font-medium mb-1">
                  Unidade/Apartamento*
                </label>
                <Input
                  id="unidade"
                  name="unidade"
                  value={formData.unidade}
                  onChange={handleInputChange}
                  placeholder="Ex: Bloco A, Ap 101"
                />
              </div>
              <div className="md:col-span-2">
                <p className="text-sm text-gray-500 mb-2">
                  Sua conta será verificada pelo administrador do condomínio
                </p>
              </div>
              <div>
                <label htmlFor="password" className="block text-sm font-medium mb-1">
                  Senha*
                </label>
                <Input
                  id="password"
                  name="password"
                  type="password"
                  value={formData.password}
                  onChange={handleInputChange}
                  placeholder="Crie uma senha"
                />
              </div>
              <div>
                <label htmlFor="confirmPassword" className="block text-sm font-medium mb-1">
                  Confirmar Senha*
                </label>
                <Input
                  id="confirmPassword"
                  name="confirmPassword"
                  type="password"
                  value={formData.confirmPassword}
                  onChange={handleInputChange}
                  placeholder="Confirme sua senha"
                />
              </div>
            </div>
          </CardContent>
          <CardFooter className="flex flex-col space-y-2">
            <Button type="submit" className="w-full bg-brand-teal hover:bg-teal-600 text-white">
              Cadastrar
            </Button>
            <div className="text-center text-sm">
              <p>Já tem uma conta?{" "}
                <Link to="/portal" className="text-brand-blue hover:underline">
                  Fazer login
                </Link>
              </p>
            </div>
          </CardFooter>
        </form>
      </Card>
    </div>
  );
};

export default PortalCadastro;
