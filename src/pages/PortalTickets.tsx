
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { 
  Card, 
  CardContent, 
  CardHeader, 
  CardTitle, 
  CardDescription 
} from "@/components/ui/card";
import { 
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
  DialogFooter
} from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { toast } from "@/hooks/use-toast";
import PortalNavbar from "@/components/portal/PortalNavbar";
import PortalSidebar from "@/components/portal/PortalSidebar";
import { 
  Plus, 
  Search, 
  Clock, 
  CheckCircle2, 
  AlertTriangle,
  AlertCircle
} from "lucide-react";

const tickets = [
  { 
    id: 1, 
    titulo: "Problema com o ar condicionado", 
    descricao: "O ar condicionado não está resfriando adequadamente.",
    data: "01/06/2023",
    status: "Em análise",
    prioridade: "Média"
  },
  { 
    id: 2, 
    titulo: "Vazamento na cozinha", 
    descricao: "Há um vazamento na pia da cozinha.",
    data: "05/06/2023",
    status: "Em execução",
    prioridade: "Alta"
  },
  { 
    id: 3, 
    titulo: "Lâmpada queimada no corredor", 
    descricao: "A lâmpada do corredor do bloco A está queimada.",
    data: "10/05/2023",
    status: "Concluído",
    prioridade: "Baixa"
  },
  { 
    id: 4, 
    titulo: "Interfone com problema", 
    descricao: "O interfone do apartamento não está funcionando.",
    data: "15/05/2023",
    status: "Concluído",
    prioridade: "Média"
  },
];

const getStatusIcon = (status: string) => {
  switch (status) {
    case "Novo":
      return <AlertCircle className="h-4 w-4 text-blue-500" />;
    case "Em análise":
      return <Clock className="h-4 w-4 text-yellow-500" />;
    case "Em execução":
      return <AlertTriangle className="h-4 w-4 text-orange-500" />;
    case "Concluído":
      return <CheckCircle2 className="h-4 w-4 text-green-500" />;
    default:
      return <AlertCircle className="h-4 w-4 text-gray-500" />;
  }
};

const getStatusClass = (status: string) => {
  switch (status) {
    case "Novo":
      return "bg-blue-100 text-blue-800";
    case "Em análise":
      return "bg-yellow-100 text-yellow-800";
    case "Em execução":
      return "bg-orange-100 text-orange-800";
    case "Concluído":
      return "bg-green-100 text-green-800";
    default:
      return "bg-gray-100 text-gray-800";
  }
};

const getPriorityClass = (prioridade: string) => {
  switch (prioridade) {
    case "Alta":
      return "bg-red-100 text-red-800";
    case "Média":
      return "bg-orange-100 text-orange-800";
    case "Baixa":
      return "bg-green-100 text-green-800";
    default:
      return "bg-gray-100 text-gray-800";
  }
};

const PortalTickets = () => {
  const navigate = useNavigate();
  const [searchQuery, setSearchQuery] = useState("");
  const [newTicket, setNewTicket] = useState({
    titulo: "",
    descricao: "",
    prioridade: "Média"
  });
  const [dialogOpen, setDialogOpen] = useState(false);

  // Simulando verificação de login
  const isLoggedIn = localStorage.getItem("portalLoggedIn") === "true";
  
  if (!isLoggedIn) {
    navigate("/portal");
    return null;
  }

  const handleInputChange = (
    e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>
  ) => {
    const { name, value } = e.target;
    setNewTicket({ ...newTicket, [name]: value });
  };

  const handleSubmit = () => {
    if (!newTicket.titulo || !newTicket.descricao) {
      toast({
        title: "Erro",
        description: "Por favor, preencha todos os campos obrigatórios",
        variant: "destructive"
      });
      return;
    }

    // Simulando criação de ticket
    toast({
      title: "Ticket criado",
      description: "Seu ticket foi criado com sucesso!"
    });
    
    setDialogOpen(false);
    setNewTicket({
      titulo: "",
      descricao: "",
      prioridade: "Média"
    });
  };

  const filteredTickets = tickets.filter(ticket => 
    ticket.titulo.toLowerCase().includes(searchQuery.toLowerCase()) || 
    ticket.descricao.toLowerCase().includes(searchQuery.toLowerCase())
  );

  return (
    <div className="min-h-screen bg-gray-100">
      <PortalNavbar />
      <div className="flex">
        <PortalSidebar />
        <main className="flex-1 p-6">
          <div className="flex justify-between items-center mb-6">
            <div>
              <h1 className="text-2xl font-bold text-gray-800">Meus Tickets</h1>
              <p className="text-gray-600">Gerencie suas solicitações</p>
            </div>
            <Dialog open={dialogOpen} onOpenChange={setDialogOpen}>
              <DialogTrigger asChild>
                <Button className="bg-brand-teal hover:bg-teal-600">
                  <Plus className="h-4 w-4 mr-1" />
                  Novo Ticket
                </Button>
              </DialogTrigger>
              <DialogContent>
                <DialogHeader>
                  <DialogTitle>Criar Novo Ticket</DialogTitle>
                  <DialogDescription>
                    Preencha os detalhes para criar uma nova solicitação
                  </DialogDescription>
                </DialogHeader>
                <div className="space-y-4 py-4">
                  <div>
                    <label htmlFor="titulo" className="block text-sm font-medium mb-1">
                      Título*
                    </label>
                    <Input
                      id="titulo"
                      name="titulo"
                      value={newTicket.titulo}
                      onChange={handleInputChange}
                      placeholder="Título do ticket"
                    />
                  </div>
                  <div>
                    <label htmlFor="descricao" className="block text-sm font-medium mb-1">
                      Descrição*
                    </label>
                    <Textarea
                      id="descricao"
                      name="descricao"
                      value={newTicket.descricao}
                      onChange={handleInputChange}
                      placeholder="Descreva o problema detalhadamente"
                      rows={4}
                    />
                  </div>
                  <div>
                    <label htmlFor="prioridade" className="block text-sm font-medium mb-1">
                      Prioridade
                    </label>
                    <select
                      id="prioridade"
                      name="prioridade"
                      value={newTicket.prioridade}
                      onChange={handleInputChange}
                      className="w-full rounded-md border border-gray-300 p-2"
                    >
                      <option value="Baixa">Baixa</option>
                      <option value="Média">Média</option>
                      <option value="Alta">Alta</option>
                    </select>
                  </div>
                </div>
                <DialogFooter>
                  <Button onClick={() => setDialogOpen(false)} variant="outline">Cancelar</Button>
                  <Button onClick={handleSubmit} className="bg-brand-teal hover:bg-teal-600">
                    Enviar Ticket
                  </Button>
                </DialogFooter>
              </DialogContent>
            </Dialog>
          </div>

          <Card className="mb-6">
            <CardContent className="py-4">
              <div className="relative">
                <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 h-4 w-4" />
                <Input 
                  placeholder="Buscar tickets..." 
                  className="pl-10"
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                />
              </div>
            </CardContent>
          </Card>

          {filteredTickets.length > 0 ? (
            <div className="space-y-4">
              {filteredTickets.map(ticket => (
                <Card key={ticket.id} className="hover:shadow-md transition-shadow">
                  <CardContent className="p-6">
                    <div className="flex justify-between items-start">
                      <div>
                        <div className="flex items-center space-x-2 mb-2">
                          {getStatusIcon(ticket.status)}
                          <span className="font-semibold text-lg">{ticket.titulo}</span>
                        </div>
                        <p className="text-sm text-gray-600 mb-3">{ticket.descricao}</p>
                        <div className="flex items-center space-x-4 text-sm text-gray-500">
                          <span>Ticket #{ticket.id}</span>
                          <span>Aberto em {ticket.data}</span>
                        </div>
                      </div>
                      <div className="flex flex-col items-end space-y-2">
                        <span className={`px-2 py-1 rounded-full text-xs ${getStatusClass(ticket.status)}`}>
                          {ticket.status}
                        </span>
                        <span className={`px-2 py-1 rounded-full text-xs ${getPriorityClass(ticket.prioridade)}`}>
                          Prioridade: {ticket.prioridade}
                        </span>
                      </div>
                    </div>
                    <div className="mt-4 pt-4 border-t flex justify-end space-x-2">
                      <Button variant="outline" size="sm">Ver detalhes</Button>
                      {ticket.status !== "Concluído" && (
                        <Button variant="outline" size="sm" className="text-red-600 border-red-200">
                          Cancelar
                        </Button>
                      )}
                    </div>
                  </CardContent>
                </Card>
              ))}
            </div>
          ) : (
            <Card>
              <CardContent className="p-8 text-center">
                <Clock className="h-12 w-12 text-gray-400 mx-auto mb-4" />
                <h3 className="text-lg font-semibold text-gray-800">Nenhum ticket encontrado</h3>
                <p className="text-gray-600 mt-1">
                  {searchQuery ? "Nenhum ticket corresponde à sua busca" : "Você ainda não possui tickets abertos"}
                </p>
                <Button className="mt-4 bg-brand-teal hover:bg-teal-600" onClick={() => setDialogOpen(true)}>
                  <Plus className="h-4 w-4 mr-1" />
                  Criar Ticket
                </Button>
              </CardContent>
            </Card>
          )}
        </main>
      </div>
    </div>
  );
};

export default PortalTickets;
