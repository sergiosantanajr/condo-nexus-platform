
import { Link } from "react-router-dom";
import { Facebook, Instagram, Twitter, Linkedin, Mail, Phone, MapPin } from "lucide-react";

const Footer = () => {
  return (
    <footer className="bg-brand-blue text-white pt-12 pb-8">
      <div className="container mx-auto px-4">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* Company Info */}
          <div>
            <div className="flex items-center space-x-2 mb-4">
              <div className="h-10 w-10 bg-white rounded-md flex items-center justify-center">
                <span className="text-brand-blue font-bold text-xl">NA</span>
              </div>
              <span className="font-montserrat font-bold text-xl">
                Nova Alternativa
              </span>
            </div>
            <p className="text-gray-300 mb-4">
              Soluções completas em administração de condomínios, com foco na qualidade e excelência no atendimento.
            </p>
            <div className="flex space-x-4">
              <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" className="hover:text-brand-teal">
                <Facebook size={20} />
              </a>
              <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" className="hover:text-brand-teal">
                <Instagram size={20} />
              </a>
              <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" className="hover:text-brand-teal">
                <Twitter size={20} />
              </a>
              <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" className="hover:text-brand-teal">
                <Linkedin size={20} />
              </a>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Links Rápidos</h3>
            <ul className="space-y-2">
              <li>
                <Link to="/" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Início
                </Link>
              </li>
              <li>
                <Link to="/quemsomos" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Quem Somos
                </Link>
              </li>
              <li>
                <Link to="/servicos" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Serviços
                </Link>
              </li>
              <li>
                <Link to="/blog" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Blog
                </Link>
              </li>
              <li>
                <Link to="/contato" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Contato
                </Link>
              </li>
            </ul>
          </div>

          {/* Portal Links */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Portal</h3>
            <ul className="space-y-2">
              <li>
                <Link to="/portal" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Acessar Portal
                </Link>
              </li>
              <li>
                <Link to="/portal/cadastro" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Cadastre-se
                </Link>
              </li>
              <li>
                <Link to="/portal/imoveis" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Imóveis
                </Link>
              </li>
              <li>
                <Link to="/portal/ajuda" className="text-gray-300 hover:text-brand-teal transition-colors">
                  Ajuda
                </Link>
              </li>
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Contato</h3>
            <div className="space-y-3">
              <div className="flex items-start">
                <MapPin size={20} className="mr-2 mt-1 flex-shrink-0" />
                <p className="text-gray-300">
                  Av. Paulista, 1000, Conjunto 101<br />
                  Bela Vista, São Paulo - SP
                </p>
              </div>
              <div className="flex items-center">
                <Phone size={20} className="mr-2 flex-shrink-0" />
                <p className="text-gray-300">(11) 5555-5555</p>
              </div>
              <div className="flex items-center">
                <Mail size={20} className="mr-2 flex-shrink-0" />
                <a href="mailto:contato@novaalternativa.com" className="text-gray-300 hover:text-brand-teal">
                  contato@novaalternativa.com
                </a>
              </div>
            </div>
          </div>
        </div>

        <hr className="border-gray-700 my-8" />

        <div className="flex flex-col md:flex-row justify-between items-center">
          <p className="text-gray-400 text-sm">
            &copy; {new Date().getFullYear()} Nova Alternativa. Todos os direitos reservados.
          </p>
          <div className="mt-4 md:mt-0">
            <ul className="flex space-x-4 text-sm text-gray-400">
              <li>
                <Link to="/privacidade" className="hover:text-brand-teal">
                  Política de Privacidade
                </Link>
              </li>
              <li>
                <Link to="/termos" className="hover:text-brand-teal">
                  Termos de Uso
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
