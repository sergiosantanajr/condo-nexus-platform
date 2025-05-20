
import { Link } from "react-router-dom";
import { 
  Home, 
  Building, 
  FileText, 
  MessageCircle, 
  Settings, 
  CreditCard, 
  Calendar, 
  FilePlus, 
  Users, 
  HelpCircle 
} from "lucide-react";

const PortalSidebar = () => {
  const menuItems = [
    { icon: <Home size={18} />, name: "Dashboard", path: "/portal/dashboard" },
    { icon: <Building size={18} />, name: "Meu Condomínio", path: "/portal/condominio" },
    { icon: <FilePlus size={18} />, name: "Anunciar Imóvel", path: "/portal/anunciar" },
    { icon: <FileText size={18} />, name: "Meus Anúncios", path: "/portal/anuncios" },
    { icon: <MessageCircle size={18} />, name: "Tickets", path: "/portal/tickets" },
    { icon: <Calendar size={18} />, name: "Reservas", path: "/portal/reservas" },
    { icon: <CreditCard size={18} />, name: "Pagamentos", path: "/portal/pagamentos" },
    { icon: <Users size={18} />, name: "Vizinhos", path: "/portal/vizinhos" },
    { icon: <HelpCircle size={18} />, name: "Ajuda", path: "/portal/ajuda" },
    { icon: <Settings size={18} />, name: "Configurações", path: "/portal/configuracoes" },
  ];

  return (
    <aside className="w-64 bg-white shadow-sm border-r h-screen hidden lg:block">
      <div className="py-4 px-4">
        <div className="mb-6">
          <h3 className="text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Menu Principal
          </h3>
        </div>
        <nav>
          <ul className="space-y-1">
            {menuItems.map((item, index) => (
              <li key={index}>
                <Link
                  to={item.path}
                  className="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-brand-teal"
                >
                  <span className="mr-3 text-gray-500">{item.icon}</span>
                  {item.name}
                </Link>
              </li>
            ))}
          </ul>
        </nav>

        <div className="mt-6 pt-6 border-t">
          <div className="px-3 py-4 rounded-md bg-blue-50">
            <div className="flex items-center">
              <FileText className="h-5 w-5 text-brand-blue mr-2" />
              <h4 className="font-semibold text-sm text-brand-blue">
                Assembleia Geral
              </h4>
            </div>
            <p className="mt-1 text-xs text-gray-700">
              Próxima assembleia: 15/06/2023 às 19h
            </p>
            <Link to="/portal/assembleias" className="mt-2 inline-block text-xs font-medium text-brand-blue">
              Ver detalhes →
            </Link>
          </div>
        </div>
      </div>
    </aside>
  );
};

export default PortalSidebar;
