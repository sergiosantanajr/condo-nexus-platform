
import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";

const HeroSection = () => {
  return (
    <div className="relative bg-gradient-to-r from-brand-blue to-blue-900 text-white">
      {/* Overlay Pattern */}
      <div 
        className="absolute inset-0 opacity-20" 
        style={{
          backgroundImage: "url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')",
        }}
      ></div>
      
      <div className="container mx-auto px-4 py-20 md:py-28 relative z-10">
        <div className="flex flex-col md:flex-row items-center">
          <div className="md:w-1/2 mb-10 md:mb-0 fade-in">
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
              Gestão de Condomínios com Excelência
            </h1>
            <p className="text-lg md:text-xl mb-8 text-gray-200 max-w-lg">
              Soluções personalizadas para uma administração condominial eficiente, moderna e transparente.
            </p>
            <div className="flex flex-wrap gap-4">
              <Link to="/contato">
                <Button size="lg" className="bg-brand-teal hover:bg-blue-600 text-white font-medium px-8">
                  Solicitar Orçamento
                </Button>
              </Link>
              <Link to="/servicos">
                <Button size="lg" variant="outline" className="bg-transparent border-white text-white hover:bg-white hover:text-brand-blue">
                  Nossos Serviços
                </Button>
              </Link>
            </div>
          </div>
          
          <div className="md:w-1/2 flex justify-center md:justify-end slide-up">
            <div className="relative">
              <div className="bg-white p-1 rounded-lg shadow-xl">
                <img 
                  src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1173&q=80" 
                  alt="Condomínio Residencial"
                  className="rounded-lg w-full h-[300px] md:h-[400px] object-cover" 
                />
              </div>
              {/* Floating Card */}
              <div className="absolute -bottom-6 -left-6 bg-white rounded-lg shadow-lg p-6 max-w-[200px]">
                <div className="text-brand-blue font-bold text-4xl mb-1">15+</div>
                <div className="text-gray-600 font-medium">Anos de experiência em administração condominial</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      {/* Wave Shape Divider */}
      <div className="absolute bottom-0 left-0 w-full overflow-hidden">
        <svg 
          viewBox="0 0 1200 120" 
          preserveAspectRatio="none" 
          className="w-full h-[60px] text-white"
          fill="currentColor"
        >
          <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
      </div>
    </div>
  );
};

export default HeroSection;
