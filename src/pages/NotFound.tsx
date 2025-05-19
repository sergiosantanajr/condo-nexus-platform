
import { useLocation, Link } from "react-router-dom";
import { useEffect } from "react";
import { Button } from "@/components/ui/button";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";

const NotFound = () => {
  const location = useLocation();

  useEffect(() => {
    console.error(
      "404 Error: User attempted to access non-existent route:",
      location.pathname
    );
  }, [location.pathname]);

  return (
    <div className="min-h-screen flex flex-col">
      <Navbar />
      
      <div className="flex-grow flex items-center justify-center py-20 bg-gray-50">
        <div className="text-center px-4">
          <div className="text-8xl font-bold text-brand-blue mb-6">404</div>
          <h1 className="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Página Não Encontrada</h1>
          <p className="text-xl text-gray-600 mb-8 max-w-md mx-auto">
            Desculpe, a página que você está procurando não existe ou foi movida.
          </p>
          <Link to="/">
            <Button size="lg" className="bg-brand-blue hover:bg-blue-800">
              Voltar para o Início
            </Button>
          </Link>
        </div>
      </div>
      
      <Footer />
    </div>
  );
};

export default NotFound;
