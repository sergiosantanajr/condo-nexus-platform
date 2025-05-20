
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card, CardContent, CardHeader, CardTitle, CardDescription, CardFooter } from "@/components/ui/card";
import { toast } from "@/hooks/use-toast";
import { Link } from "react-router-dom";

const PortalLogin = () => {
  const navigate = useNavigate();
  const [credentials, setCredentials] = useState({
    email: "",
    password: "",
  });

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setCredentials({ ...credentials, [name]: value });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    // Simulando autenticação
    if (!credentials.email || !credentials.password) {
      toast({
        title: "Erro",
        description: "Por favor, preencha todos os campos",
        variant: "destructive"
      });
      return;
    }

    // Para fins de demonstração, aceitamos qualquer login
    toast({
      title: "Login realizado",
      description: "Bem-vindo ao Portal do Condômino"
    });
    localStorage.setItem("portalLoggedIn", "true");
    navigate("/portal/dashboard");
  };

  return (
    <div className="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <Card className="w-full max-w-md">
        <CardHeader className="text-center">
          <div className="mx-auto mb-4 w-12 h-12 bg-brand-teal rounded-md flex items-center justify-center">
            <span className="text-white font-bold text-xl">NA</span>
          </div>
          <CardTitle className="text-2xl font-bold text-brand-blue">Portal do Condômino</CardTitle>
          <CardDescription>
            Acesse seus serviços e informações
          </CardDescription>
        </CardHeader>
        <form onSubmit={handleSubmit}>
          <CardContent>
            <div className="space-y-4">
              <div>
                <label htmlFor="email" className="block text-sm font-medium mb-1">
                  Email
                </label>
                <Input
                  id="email"
                  name="email"
                  type="email"
                  placeholder="seu-email@exemplo.com.br"
                  value={credentials.email}
                  onChange={handleInputChange}
                />
              </div>
              <div>
                <label htmlFor="password" className="block text-sm font-medium mb-1">
                  Senha
                </label>
                <Input
                  id="password"
                  type="password"
                  name="password"
                  placeholder="Sua senha"
                  value={credentials.password}
                  onChange={handleInputChange}
                />
              </div>
              <div className="flex justify-between text-sm">
                <label className="flex items-center">
                  <input type="checkbox" className="mr-2" />
                  <span>Lembrar-me</span>
                </label>
                <a href="#" className="text-brand-blue hover:underline">
                  Esqueceu a senha?
                </a>
              </div>
            </div>
          </CardContent>
          <CardFooter className="flex flex-col space-y-2">
            <Button type="submit" className="w-full bg-brand-teal hover:bg-teal-600 text-white">
              Entrar
            </Button>
            <div className="text-center text-sm">
              <p>Não tem uma conta?{" "}
                <Link to="/portal/cadastro" className="text-brand-blue hover:underline">
                  Cadastre-se
                </Link>
              </p>
            </div>
            <a href="/" className="text-sm text-gray-500 hover:text-brand-blue text-center mt-2">
              Voltar para o site
            </a>
          </CardFooter>
        </form>
      </Card>
    </div>
  );
};

export default PortalLogin;
