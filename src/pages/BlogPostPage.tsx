
import { useEffect, useState } from "react";
import { useParams, Link } from "react-router-dom";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import WhatsAppButton from "@/components/WhatsAppButton";
import { Card } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { ChevronLeft, Calendar, User } from "lucide-react";

interface BlogPost {
  id: number;
  title: string;
  content: string;
  author: string;
  date: string;
  image: string;
  category: string;
}

const BlogPostPage = () => {
  const { id } = useParams<{ id: string }>();
  const [post, setPost] = useState<BlogPost | null>(null);
  const [loading, setLoading] = useState(true);
  
  useEffect(() => {
    // Simulando carregamento de um post específico
    setTimeout(() => {
      setPost({
        id: Number(id),
        title: "Como gerenciar um condomínio de forma eficiente",
        content: `
        <p>Administrar um condomínio é uma tarefa que exige habilidade, organização e conhecimento. Neste artigo, vamos explorar as melhores práticas para garantir uma gestão condominial eficiente e transparente.</p>
        
        <h2>Comunicação eficiente</h2>
        <p>Uma comunicação clara com os condôminos é fundamental. Utilize canais diversos como e-mails, aplicativos de mensagem, murais informativos e reuniões regulares para manter todos informados sobre decisões, obras e prestação de contas.</p>
        
        <h2>Gestão financeira transparente</h2>
        <p>A transparência nas finanças é crucial para estabelecer confiança. Apresente balancetes mensais detalhados, realize prestações de contas periódicas e mantenha um fundo de reserva adequado para emergências.</p>
        
        <h2>Manutenção preventiva</h2>
        <p>É mais econômico prevenir do que remediar. Crie um cronograma de manutenções preventivas para elevadores, bombas d'água, sistemas elétricos e outros equipamentos vitais. Isto evita emergências e prolonga a vida útil dos sistemas.</p>
        
        <h2>Conhecimento das normas legais</h2>
        <p>Mantenha-se atualizado sobre a legislação condominial, especialmente a Lei 4.591/64 (Lei dos Condomínios) e o Código Civil. O desconhecimento das normas pode resultar em problemas jurídicos.</p>
        
        <h2>Assembleia bem organizada</h2>
        <p>Prepare-se adequadamente para as assembleias, com pautas claras enviadas com antecedência, ambiente adequado e condução organizada das discussões. Registre corretamente as decisões em ata.</p>
        
        <h2>Tecnologia a favor da gestão</h2>
        <p>Utilize softwares específicos para gestão condominial, que ajudam a organizar documentos, comunicações, reservas de áreas comuns e controle de acesso. A tecnologia pode otimizar processos e reduzir custos operacionais.</p>
        
        <h2>Conclusão</h2>
        <p>Uma gestão condominial eficiente requer dedicação, conhecimento e uso adequado de recursos. Seguindo essas orientações, é possível criar um ambiente harmonioso e valorizar o patrimônio de todos.</p>
        `,
        author: "Ana Silva",
        date: "15/05/2025",
        image: "https://images.unsplash.com/photo-1560518883-ce09059eeffa",
        category: "Administração"
      });
      setLoading(false);
    }, 1000);
  }, [id]);

  if (loading) {
    return (
      <div className="min-h-screen flex flex-col">
        <Navbar />
        <div className="flex-grow flex items-center justify-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-blue"></div>
        </div>
        <Footer />
      </div>
    );
  }

  if (!post) {
    return (
      <div className="min-h-screen flex flex-col">
        <Navbar />
        <div className="flex-grow container mx-auto px-4 py-20 text-center">
          <h1 className="text-3xl font-bold text-gray-800 mb-4">Artigo não encontrado</h1>
          <p className="text-gray-600 mb-8">O artigo que você está procurando não existe ou foi removido.</p>
          <Link to="/blog">
            <Button className="bg-brand-blue hover:bg-blue-800">
              Voltar para o Blog
            </Button>
          </Link>
        </div>
        <Footer />
      </div>
    );
  }

  return (
    <div className="min-h-screen flex flex-col">
      <Navbar />
      
      <main className="flex-grow pt-20 pb-16">
        <div className="container mx-auto px-4">
          <Link to="/blog" className="inline-flex items-center text-brand-blue mb-6 hover:underline">
            <ChevronLeft className="h-4 w-4 mr-1" />
            Voltar para o Blog
          </Link>
          
          <div className="relative rounded-xl overflow-hidden h-[400px] mb-8">
            <img 
              src={post.image} 
              alt={post.title}
              className="absolute w-full h-full object-cover" 
            />
            <div className="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
              <div className="p-8 text-white">
                <span className="bg-brand-teal text-white text-sm px-3 py-1 rounded-full mb-4 inline-block">
                  {post.category}
                </span>
                <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                  {post.title}
                </h1>
                <div className="flex items-center text-gray-200 text-sm">
                  <div className="flex items-center mr-4">
                    <User className="h-4 w-4 mr-1" />
                    <span>{post.author}</span>
                  </div>
                  <div className="flex items-center">
                    <Calendar className="h-4 w-4 mr-1" />
                    <span>{post.date}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div className="max-w-4xl mx-auto">
            <Card className="p-8">
              <div 
                className="prose prose-lg max-w-none" 
                dangerouslySetInnerHTML={{ __html: post.content }}
              ></div>
            </Card>
            
            <div className="flex justify-between items-center mt-8">
              <Link to={`/blog/${Number(id) - 1}`}>
                <Button 
                  variant="outline"
                  disabled={Number(id) <= 1} 
                  className="flex items-center"
                >
                  <ChevronLeft className="h-4 w-4 mr-1" />
                  Artigo anterior
                </Button>
              </Link>
              <Link to={`/blog/${Number(id) + 1}`}>
                <Button 
                  variant="outline"
                  className="flex items-center"
                >
                  Próximo artigo
                  <ChevronLeft className="h-4 w-4 ml-1 rotate-180" />
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </main>
      
      <Footer />
      <WhatsAppButton />
    </div>
  );
};

export default BlogPostPage;
