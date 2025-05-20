
import { useNavigate } from "react-router-dom";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import AdminNavbar from "@/components/admin/AdminNavbar";
import AdminSidebar from "@/components/admin/AdminSidebar";
import { BarChart, Users, FileText, MessageCircle, AlertTriangle, CheckCircle } from "lucide-react";

const AdminDashboard = () => {
  const navigate = useNavigate();

  // Simulando verificação de login
  const isLoggedIn = localStorage.getItem("adminLoggedIn") === "true";
  
  if (!isLoggedIn) {
    navigate("/admin");
    return null;
  }

  const stats = [
    { title: "Condomínios", value: "32", icon: <Users className="h-8 w-8 text-brand-teal" />, change: "+2 este mês" },
    { title: "Tickets Abertos", value: "14", icon: <MessageCircle className="h-8 w-8 text-yellow-500" />, change: "5 urgentes" },
    { title: "Postagens no Blog", value: "28", icon: <FileText className="h-8 w-8 text-brand-blue" />, change: "+3 esta semana" },
    { title: "Visitantes", value: "1.258", icon: <BarChart className="h-8 w-8 text-purple-500" />, change: "+12% este mês" },
  ];

  const recentTickets = [
    { id: 1, title: "Problemas com a Porta", condominio: "Edifício Azul", prioridade: "Urgente", status: "Novo" },
    { id: 2, title: "Vazamento na Garagem", condominio: "Residencial Verde", prioridade: "Alta", status: "Em análise" },
    { id: 3, title: "Manutenção elevador", condominio: "Condomínio Solar", prioridade: "Média", status: "Em execução" },
    { id: 4, title: "Iluminação da área comum", condominio: "Villa Serena", prioridade: "Baixa", status: "Concluído" },
  ];

  return (
    <div className="min-h-screen bg-gray-100">
      <AdminNavbar />
      <div className="flex">
        <AdminSidebar />
        <main className="flex-1 p-6">
          <h1 className="text-2xl font-bold text-gray-800 mb-6">Painel de Controle</h1>
          
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {stats.map((stat, index) => (
              <Card key={index}>
                <CardContent className="p-6">
                  <div className="flex items-center justify-between">
                    <div>
                      <p className="text-sm font-medium text-gray-500">{stat.title}</p>
                      <p className="text-3xl font-bold">{stat.value}</p>
                      <p className="text-xs text-gray-500 mt-1">{stat.change}</p>
                    </div>
                    <div>{stat.icon}</div>
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <Card className="lg:col-span-2">
              <CardHeader>
                <CardTitle>Tickets Recentes</CardTitle>
              </CardHeader>
              <CardContent>
                <div className="overflow-x-auto">
                  <table className="w-full">
                    <thead>
                      <tr className="border-b">
                        <th className="text-left pb-2 font-medium text-gray-500">ID</th>
                        <th className="text-left pb-2 font-medium text-gray-500">Título</th>
                        <th className="text-left pb-2 font-medium text-gray-500">Condomínio</th>
                        <th className="text-left pb-2 font-medium text-gray-500">Prioridade</th>
                        <th className="text-left pb-2 font-medium text-gray-500">Status</th>
                        <th className="text-left pb-2 font-medium text-gray-500">Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      {recentTickets.map((ticket) => (
                        <tr key={ticket.id} className="border-b hover:bg-gray-50">
                          <td className="py-3">{ticket.id}</td>
                          <td className="py-3">{ticket.title}</td>
                          <td className="py-3">{ticket.condominio}</td>
                          <td className="py-3">
                            <span className={`px-2 py-1 rounded-full text-xs ${
                              ticket.prioridade === "Urgente" ? "bg-red-100 text-red-800" :
                              ticket.prioridade === "Alta" ? "bg-orange-100 text-orange-800" :
                              ticket.prioridade === "Média" ? "bg-yellow-100 text-yellow-800" :
                              "bg-green-100 text-green-800"
                            }`}>
                              {ticket.prioridade}
                            </span>
                          </td>
                          <td className="py-3">
                            <span className={`px-2 py-1 rounded-full text-xs ${
                              ticket.status === "Novo" ? "bg-blue-100 text-blue-800" :
                              ticket.status === "Em análise" ? "bg-purple-100 text-purple-800" :
                              ticket.status === "Em execução" ? "bg-orange-100 text-orange-800" :
                              "bg-green-100 text-green-800"
                            }`}>
                              {ticket.status}
                            </span>
                          </td>
                          <td className="py-3">
                            <Button variant="outline" size="sm">Ver</Button>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                  <div className="mt-4 text-center">
                    <Button variant="outline" className="text-brand-blue">
                      Ver todos os tickets
                    </Button>
                  </div>
                </div>
              </CardContent>
            </Card>
            
            <Card>
              <CardHeader>
                <CardTitle>Visão Geral</CardTitle>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  <div className="flex items-center justify-between">
                    <div className="flex items-center">
                      <AlertTriangle className="h-5 w-5 text-yellow-500 mr-2" />
                      <span>Tickets Pendentes</span>
                    </div>
                    <span className="font-bold">12</span>
                  </div>
                  <div className="flex items-center justify-between">
                    <div className="flex items-center">
                      <CheckCircle className="h-5 w-5 text-green-500 mr-2" />
                      <span>Tickets Resolvidos</span>
                    </div>
                    <span className="font-bold">28</span>
                  </div>
                  <div className="flex items-center justify-between">
                    <div className="flex items-center">
                      <Users className="h-5 w-5 text-brand-blue mr-2" />
                      <span>Total de Usuários</span>
                    </div>
                    <span className="font-bold">243</span>
                  </div>
                  <div className="flex items-center justify-between">
                    <div className="flex items-center">
                      <FileText className="h-5 w-5 text-brand-blue mr-2" />
                      <span>Imóveis Anunciados</span>
                    </div>
                    <span className="font-bold">18</span>
                  </div>
                </div>
                <div className="mt-6">
                  <Button className="w-full bg-brand-blue hover:bg-blue-900">
                    Gerar Relatório
                  </Button>
                </div>
              </CardContent>
            </Card>
          </div>
        </main>
      </div>
    </div>
  );
};

export default AdminDashboard;
