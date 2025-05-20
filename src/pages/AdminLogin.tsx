
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card, CardContent, CardHeader, CardTitle, CardDescription, CardFooter } from "@/components/ui/card";
import { toast } from "@/hooks/use-toast";

const AdminLogin = () => {
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
      description: "Bem-vindo ao painel administrativo"
    });
    localStorage.setItem("adminLoggedIn", "true");
    navigate("/admin/dashboard");
  };

  return (
    <div className="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <Card className="w-full max-w-md">
        <CardHeader className="text-center">
          <div className="mx-auto mb-4 w-12 h-12 bg-brand-blue rounded-md flex items-center justify-center">
            <span className="text-white font-bold text-xl">NA</span>
          </div>
          <CardTitle className="text-2xl font-bold text-brand-blue">Painel Administrativo</CardTitle>
          <CardDescription>
            Acesse o painel para gerenciar seu site
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
            </div>
          </CardContent>
          <CardFooter className="flex flex-col space-y-2">
            <Button type="submit" className="w-full bg-brand-blue hover:bg-blue-900 text-white">
              Entrar
            </Button>
            <a href="/" className="text-sm text-gray-500 hover:text-brand-blue text-center">
              Voltar para o site
            </a>
          </CardFooter>
        </form>
      </Card>
    </div>
  );
};

export default AdminLogin;
