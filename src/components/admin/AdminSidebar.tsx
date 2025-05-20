
import { Link } from "react-router-dom";
import { 
  Home, 
  Users, 
  FileText, 
  MessageCircle, 
  Settings, 
  Layers, 
  Image, 
  BarChart, 
  Globe, 
  AlertTriangle 
} from "lucide-react";

const AdminSidebar = () => {
  const menuItems = [
    { icon: <Home size={18} />, name: "Dashboard", path: "/admin/dashboard" },
    { icon: <FileText size={18} />, name: "Páginas", path: "/admin/pages" },
    { icon: <FileText size={18} />, name: "Blog", path: "/admin/blog" },
    { icon: <MessageCircle size={18} />, name: "Tickets", path: "/admin/tickets" },
    { icon: <Users size={18} />, name: "Condomínios", path: "/admin/condominios" },
    { icon: <Layers size={18} />, name: "Imóveis", path: "/admin/imoveis" },
    { icon: <Image size={18} />, name: "Mídia", path: "/admin/media" },
    { icon: <Globe size={18} />, name: "SEO", path: "/admin/seo" },
    { icon: <BarChart size={18} />, name: "Relatórios", path: "/admin/relatorios" },
    { icon: <Settings size={18} />, name: "Configurações", path: "/admin/settings" },
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
                  className="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100 hover:text-brand-blue"
                >
                  <span className="mr-3 text-gray-500">{item.icon}</span>
                  {item.name}
                </Link>
              </li>
            ))}
          </ul>
        </nav>

        <div className="mt-6 pt-6 border-t">
          <div className="px-3 py-4 rounded-md bg-yellow-50">
            <div className="flex items-center">
              <AlertTriangle className="h-5 w-5 text-yellow-500 mr-2" />
              <h4 className="font-semibold text-sm text-yellow-800">
                5 tickets urgentes
              </h4>
            </div>
            <p className="mt-1 text-xs text-yellow-700">
              Há tickets urgentes aguardando sua atenção.
            </p>
            <Link to="/admin/tickets" className="mt-2 inline-block text-xs font-medium text-brand-blue">
              Ver tickets →
            </Link>
          </div>
        </div>
      </div>
    </aside>
  );
};

export default AdminSidebar;
