
import { useNavigate } from "react-router-dom";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import PortalNavbar from "@/components/portal/PortalNavbar";
import PortalSidebar from "@/components/portal/PortalSidebar";
import { 
  Home, 
  FileText, 
  MessageCircle, 
  Clock, 
  Plus, 
  Calendar, 
  AlertCircle 
} from "lucide-react";

const PortalDashboard = () => {
  const navigate = useNavigate();

  // Simulando verificação de login
  const isLoggedIn = localStorage.getItem("portalLoggedIn") === "true";
  
  if (!isLoggedIn) {
    navigate("/portal");
    return null;
  }

  // Dados de exemplo
  const meuImoveis = [
    { id: 1, titulo: "Apartamento 101", tipo: "Venda", valor: "R$ 350.000,00", visitas: 24 },
    { id: 2, titulo: "Vaga de Garagem", tipo: "Aluguel", valor: "R$ 200,00/mês", visitas: 12 },
  ];

  const comunicados = [
    { id: 1, titulo: "Manutenção na Piscina", data: "23/05/2023" },
    { id: 2, titulo: "Assembleia Geral", data: "15/06/2023" },
    { id: 3, titulo: "Limpeza de Caixas d'água", data: "10/07/2023" },
  ];

  return (
    <div className="min-h-screen bg-gray-100">
      <PortalNavbar />
      <div className="flex">
        <PortalSidebar />
        <main className="flex-1 p-6">
          <h1 className="text-2xl font-bold text-gray-800 mb-2">Olá, Morador!</h1>
          <p className="text-gray-600 mb-6">Bem-vindo ao Portal do Condômino Nova Alternativa</p>
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <Card>
              <CardContent className="p-6">
                <div className="flex justify-between items-center">
                  <div className="p-3 rounded-full bg-blue-100">
                    <Home className="h-6 w-6 text-brand-blue" />
                  </div>
                  <span className="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Ativo</span>
                </div>
                <h3 className="mt-4 font-medium">Meu Condomínio</h3>
                <p className="text-2xl font-bold mt-1">Residencial Majestic</p>
                <p className="text-sm text-gray-500 mt-1">Bloco A - Apartamento 101</p>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-6">
                <div className="flex justify-between items-center">
                  <div className="p-3 rounded-full bg-red-100">
                    <AlertCircle className="h-6 w-6 text-red-600" />
                  </div>
                  <span className="text-xs text-gray-500">Último pagamento</span>
                </div>
                <h3 className="mt-4 font-medium">Taxa Condominial</h3>
                <p className="text-2xl font-bold mt-1">R$ 580,00</p>
                <p className="text-sm text-gray-500 mt-1">Vencimento: 10/06/2023</p>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-6">
                <div className="flex justify-between items-center">
                  <div className="p-3 rounded-full bg-orange-100">
                    <MessageCircle className="h-6 w-6 text-orange-600" />
                  </div>
                  <span className="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">2 Abertos</span>
                </div>
                <h3 className="mt-4 font-medium">Meus Tickets</h3>
                <p className="text-2xl font-bold mt-1">2</p>
                <p className="text-sm text-gray-500 mt-1">1 ticket em andamento</p>
              </CardContent>
            </Card>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <Card className="lg:col-span-2">
              <CardHeader>
                <div className="flex items-center justify-between">
                  <CardTitle>Meus Imóveis</CardTitle>
                  <Button className="bg-brand-teal hover:bg-teal-600">
                    <Plus className="h-4 w-4 mr-1" />
                    Anunciar Imóvel
                  </Button>
                </div>
              </CardHeader>
              <CardContent>
                {meuImoveis.length > 0 ? (
                  <div className="overflow-x-auto">
                    <table className="w-full">
                      <thead>
                        <tr className="border-b">
                          <th className="text-left pb-2 font-medium text-gray-500">Imóvel</th>
                          <th className="text-left pb-2 font-medium text-gray-500">Tipo</th>
                          <th className="text-left pb-2 font-medium text-gray-500">Valor</th>
                          <th className="text-left pb-2 font-medium text-gray-500">Visitas</th>
                          <th className="text-left pb-2 font-medium text-gray-500">Ação</th>
                        </tr>
                      </thead>
                      <tbody>
                        {meuImoveis.map((imovel) => (
                          <tr key={imovel.id} className="border-b hover:bg-gray-50">
                            <td className="py-3">{imovel.titulo}</td>
                            <td className="py-3">
                              <span className={`px-2 py-1 rounded-full text-xs ${
                                imovel.tipo === "Venda" ? "bg-green-100 text-green-800" : "bg-blue-100 text-blue-800"
                              }`}>
                                {imovel.tipo}
                              </span>
                            </td>
                            <td className="py-3">{imovel.valor}</td>
                            <td className="py-3">{imovel.visitas}</td>
                            <td className="py-3">
                              <Button variant="outline" size="sm">Editar</Button>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                ) : (
                  <div className="text-center py-8">
                    <FileText className="h-10 w-10 text-gray-400 mx-auto mb-2" />
                    <p className="text-gray-500">Você ainda não anunciou nenhum imóvel</p>
                    <Button className="mt-4 bg-brand-teal hover:bg-teal-600">
                      Anunciar Imóvel
                    </Button>
                  </div>
                )}
              </CardContent>
            </Card>
            
            <Card>
              <CardHeader>
                <CardTitle>Comunicados Recentes</CardTitle>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  {comunicados.map((comunicado) => (
                    <div key={comunicado.id} className="flex gap-4 items-start border-b pb-4">
                      <div className="p-2 rounded-full bg-gray-100">
                        <Calendar className="h-4 w-4 text-gray-600" />
                      </div>
                      <div>
                        <h4 className="font-medium">{comunicado.titulo}</h4>
                        <p className="text-sm text-gray-500">{comunicado.data}</p>
                      </div>
                    </div>
                  ))}
                  <Button variant="outline" className="w-full">
                    Ver Todos
                  </Button>
                </div>
              </CardContent>
            </Card>
          </div>

          <div className="mt-6">
            <Card>
              <CardHeader>
                <div className="flex items-center justify-between">
                  <CardTitle>Tickets Recentes</CardTitle>
                  <Button variant="outline">
                    <Plus className="h-4 w-4 mr-1" />
                    Novo Ticket
                  </Button>
                </div>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  <div className="flex gap-4 items-start border-b pb-4">
                    <div className="p-2 rounded-full bg-yellow-100">
                      <Clock className="h-4 w-4 text-yellow-600" />
                    </div>
                    <div className="flex-1">
                      <div className="flex justify-between">
                        <h4 className="font-medium">Problema com o ar condicionado</h4>
                        <span className="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Em análise</span>
                      </div>
                      <p className="text-sm text-gray-500 mt-1">
                        Ticket #1234 - Aberto em 01/06/2023
                      </p>
                      <p className="text-sm mt-2">
                        O ar condicionado não está resfriando adequadamente.
                      </p>
                    </div>
                  </div>
                  
                  <div className="flex gap-4 items-start border-b pb-4">
                    <div className="p-2 rounded-full bg-orange-100">
                      <Clock className="h-4 w-4 text-orange-600" />
                    </div>
                    <div className="flex-1">
                      <div className="flex justify-between">
                        <h4 className="font-medium">Vazamento na cozinha</h4>
                        <span className="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs">Em execução</span>
                      </div>
                      <p className="text-sm text-gray-500 mt-1">
                        Ticket #1235 - Aberto em 05/06/2023
                      </p>
                      <p className="text-sm mt-2">
                        Há um vazamento na pia da cozinha.
                      </p>
                    </div>
                  </div>
                </div>
                
                <Button variant="outline" className="w-full mt-4">
                  Ver Todos os Tickets
                </Button>
              </CardContent>
            </Card>
          </div>
        </main>
      </div>
    </div>
  );
};

export default PortalDashboard;
