
import { useState } from "react";
import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Menu, X, ChevronDown } from "lucide-react";

const Navbar = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [dropdownOpen, setDropdownOpen] = useState(false);

  return (
    <nav className="bg-white shadow-md sticky top-0 z-50">
      <div className="container mx-auto px-4 py-3">
        <div className="flex items-center justify-between">
          {/* Logo */}
          <Link to="/" className="flex items-center space-x-2">
            <div className="h-10 w-10 bg-brand-blue rounded-md flex items-center justify-center">
              <span className="text-white font-bold text-xl">NA</span>
            </div>
            <span className="font-montserrat font-bold text-xl text-brand-blue">
              Nova Alternativa
            </span>
          </Link>

          {/* Desktop Navigation */}
          <div className="hidden md:flex items-center space-x-8">
            <Link to="/" className="text-gray-700 hover:text-brand-blue transition-colors font-medium">
              Início
            </Link>
            <Link to="/quemsomos" className="text-gray-700 hover:text-brand-blue transition-colors font-medium">
              Quem Somos
            </Link>
            <div className="relative">
              <button 
                onClick={() => setDropdownOpen(!dropdownOpen)}
                className="flex items-center text-gray-700 hover:text-brand-blue transition-colors font-medium"
              >
                Serviços <ChevronDown size={16} className="ml-1" />
              </button>
              {dropdownOpen && (
                <div className="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-10">
                  <Link 
                    to="/servicos/administracao" 
                    className="block px-4 py-2 hover:bg-gray-100 text-gray-700"
                  >
                    Administração
                  </Link>
                  <Link 
                    to="/servicos/consultoria" 
                    className="block px-4 py-2 hover:bg-gray-100 text-gray-700"
                  >
                    Consultoria
                  </Link>
                  <Link 
                    to="/servicos/manutencao" 
                    className="block px-4 py-2 hover:bg-gray-100 text-gray-700"
                  >
                    Manutenção
                  </Link>
                </div>
              )}
            </div>
            <Link to="/blog" className="text-gray-700 hover:text-brand-blue transition-colors font-medium">
              Blog
            </Link>
            <Link to="/contato" className="text-gray-700 hover:text-brand-blue transition-colors font-medium">
              Contato
            </Link>
          </div>

          {/* Login and Portal Access */}
          <div className="hidden md:flex items-center space-x-3">
            <Link to="/portal">
              <Button variant="outline" className="border-brand-teal text-brand-teal hover:text-white hover:bg-brand-teal">
                Portal
              </Button>
            </Link>
            <Link to="/admin">
              <Button className="bg-brand-blue hover:bg-blue-900 text-white">
                Admin
              </Button>
            </Link>
          </div>

          {/* Mobile menu button */}
          <div className="md:hidden">
            <button 
              onClick={() => setIsMenuOpen(!isMenuOpen)} 
              className="text-gray-700"
            >
              {isMenuOpen ? (
                <X size={24} />
              ) : (
                <Menu size={24} />
              )}
            </button>
          </div>
        </div>

        {/* Mobile menu */}
        {isMenuOpen && (
          <div className="md:hidden mt-4 pb-4 space-y-4 slide-up">
            <Link 
              to="/"
              className="block py-2 text-gray-700 hover:text-brand-blue"
              onClick={() => setIsMenuOpen(false)}
            >
              Início
            </Link>
            <Link 
              to="/quemsomos" 
              className="block py-2 text-gray-700 hover:text-brand-blue"
              onClick={() => setIsMenuOpen(false)}
            >
              Quem Somos
            </Link>
            <div>
              <button 
                onClick={() => setDropdownOpen(!dropdownOpen)}
                className="flex items-center py-2 text-gray-700 hover:text-brand-blue"
              >
                Serviços <ChevronDown size={16} className="ml-1" />
              </button>
              {dropdownOpen && (
                <div className="pl-4 space-y-2 mt-2">
                  <Link 
                    to="/servicos/administracao" 
                    className="block py-2 text-gray-700 hover:text-brand-blue"
                    onClick={() => setIsMenuOpen(false)}
                  >
                    Administração
                  </Link>
                  <Link 
                    to="/servicos/consultoria" 
                    className="block py-2 text-gray-700 hover:text-brand-blue"
                    onClick={() => setIsMenuOpen(false)}
                  >
                    Consultoria
                  </Link>
                  <Link 
                    to="/servicos/manutencao" 
                    className="block py-2 text-gray-700 hover:text-brand-blue"
                    onClick={() => setIsMenuOpen(false)}
                  >
                    Manutenção
                  </Link>
                </div>
              )}
            </div>
            <Link 
              to="/blog" 
              className="block py-2 text-gray-700 hover:text-brand-blue"
              onClick={() => setIsMenuOpen(false)}
            >
              Blog
            </Link>
            <Link 
              to="/contato" 
              className="block py-2 text-gray-700 hover:text-brand-blue"
              onClick={() => setIsMenuOpen(false)}
            >
              Contato
            </Link>
            <div className="pt-2 flex flex-col space-y-2">
              <Link to="/portal" onClick={() => setIsMenuOpen(false)}>
                <Button variant="outline" className="w-full border-brand-teal text-brand-teal hover:text-white hover:bg-brand-teal">
                  Portal
                </Button>
              </Link>
              <Link to="/admin" onClick={() => setIsMenuOpen(false)}>
                <Button className="w-full bg-brand-blue hover:bg-blue-900 text-white">
                  Admin
                </Button>
              </Link>
            </div>
          </div>
        )}
      </div>
    </nav>
  );
};

export default Navbar;
