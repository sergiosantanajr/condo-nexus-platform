
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card, CardContent, CardHeader, CardTitle, CardDescription, CardFooter } from "@/components/ui/card";
import { toast } from "@/hooks/use-toast";

const Install = () => {
  const navigate = useNavigate();
  const [step, setStep] = useState(1);
  const [dbConfig, setDbConfig] = useState({
    host: "",
    username: "",
    password: "",
    database: "",
  });

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setDbConfig({ ...dbConfig, [name]: value });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    // Simulando validação e criação do banco de dados
    if (!dbConfig.host || !dbConfig.username || !dbConfig.database) {
      toast({
        title: "Erro",
        description: "Por favor, preencha todos os campos obrigatórios",
        variant: "destructive"
      });
      return;
    }

    // Simulando progresso da instalação
    toast({
      title: "Conectando ao banco de dados",
      description: "Por favor, aguarde..."
    });
    
    setTimeout(() => {
      if (step === 1) {
        setStep(2);
        toast({
          title: "Conexão estabelecida",
          description: "Banco de dados conectado com sucesso!"
        });
      } else {
        // Simulando instalação concluída
        toast({
          title: "Instalação concluída",
          description: "Sistema instalado com sucesso!"
        });
        localStorage.setItem("installed", "true");
        navigate("/admin");
      }
    }, 2000);
  };

  return (
    <div className="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <Card className="w-full max-w-md">
        <CardHeader className="text-center">
          <div className="mx-auto mb-4 w-12 h-12 bg-brand-blue rounded-md flex items-center justify-center">
            <span className="text-white font-bold text-xl">NA</span>
          </div>
          <CardTitle className="text-2xl font-bold text-brand-blue">Nova Alternativa</CardTitle>
          <CardDescription>
            {step === 1 ? "Configuração do Banco de Dados" : "Finalizar Instalação"}
          </CardDescription>
        </CardHeader>
        <form onSubmit={handleSubmit}>
          <CardContent>
            {step === 1 ? (
              <div className="space-y-4">
                <div>
                  <label htmlFor="host" className="block text-sm font-medium mb-1">
                    Servidor MySQL
                  </label>
                  <Input
                    id="host"
                    name="host"
                    placeholder="localhost"
                    value={dbConfig.host}
                    onChange={handleInputChange}
                  />
                </div>
                <div>
                  <label htmlFor="username" className="block text-sm font-medium mb-1">
                    Usuário
                  </label>
                  <Input
                    id="username"
                    name="username"
                    placeholder="root"
                    value={dbConfig.username}
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
                    placeholder="Senha do banco de dados"
                    value={dbConfig.password}
                    onChange={handleInputChange}
                  />
                </div>
                <div>
                  <label htmlFor="database" className="block text-sm font-medium mb-1">
                    Nome do Banco de Dados
                  </label>
                  <Input
                    id="database"
                    name="database"
                    placeholder="novaalternativa"
                    value={dbConfig.database}
                    onChange={handleInputChange}
                  />
                </div>
              </div>
            ) : (
              <div className="space-y-4">
                <div className="bg-green-50 p-4 rounded-md text-green-800">
                  <p className="font-medium">Banco de dados configurado com sucesso!</p>
                  <p className="text-sm mt-1">Clique em concluir para finalizar a instalação e criar o administrador.</p>
                </div>
                <div>
                  <label htmlFor="adminEmail" className="block text-sm font-medium mb-1">
                    Email do Administrador
                  </label>
                  <Input
                    id="adminEmail"
                    name="adminEmail"
                    type="email"
                    placeholder="admin@exemplo.com.br"
                  />
                </div>
                <div>
                  <label htmlFor="adminPassword" className="block text-sm font-medium mb-1">
                    Senha do Administrador
                  </label>
                  <Input
                    id="adminPassword"
                    name="adminPassword"
                    type="password"
                    placeholder="Senha do administrador"
                  />
                </div>
              </div>
            )}
          </CardContent>
          <CardFooter>
            <Button type="submit" className="w-full bg-brand-blue hover:bg-blue-900 text-white">
              {step === 1 ? "Próximo" : "Concluir Instalação"}
            </Button>
          </CardFooter>
        </form>
      </Card>
    </div>
  );
};

export default Install;
