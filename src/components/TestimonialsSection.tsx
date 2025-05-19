
import { Separator } from "@/components/ui/separator";
import { Card, CardContent } from "@/components/ui/card";

const testimonials = [
  {
    name: "Ricardo Almeida",
    role: "Síndico - Cond. Jardim das Flores",
    content: "A Nova Alternativa transformou a gestão do nosso condomínio. Agora temos transparência total nas contas e os problemas são solucionados com rapidez impressionante.",
    image: "https://randomuser.me/api/portraits/men/32.jpg",
  },
  {
    name: "Ana Carolina Silva",
    role: "Moradora - Cond. Vista Verde",
    content: "Desde que a administração mudou para a Nova Alternativa, percebemos melhorias significativas na manutenção e segurança do condomínio. O portal do morador então é uma mão na roda!",
    image: "https://randomuser.me/api/portraits/women/44.jpg",
  },
  {
    name: "Roberto Mendes",
    role: "Síndico - Cond. Alto da Boa Vista",
    content: "A consultoria oferecida pela equipe nos ajudou a regularizar questões antigas do condomínio e implementar melhorias que pareciam impossíveis. Recomendo fortemente.",
    image: "https://randomuser.me/api/portraits/men/62.jpg",
  },
];

const TestimonialsSection = () => {
  return (
    <section className="py-20 bg-gray-50">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-3xl md:text-4xl font-bold mb-4 text-brand-blue">
            O que dizem nossos clientes
          </h2>
          <div className="w-20 h-1 bg-brand-teal mx-auto mb-8"></div>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            A satisfação dos nossos clientes é nosso maior patrimônio.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {testimonials.map((testimonial, index) => (
            <Card 
              key={index} 
              className="overflow-hidden hover:shadow-lg transition-shadow"
            >
              <CardContent className="p-6">
                <div className="flex flex-col h-full">
                  <div className="flex-grow">
                    <div className="mb-6">
                      <svg width="45" height="36" className="text-brand-teal opacity-30">
                        <path
                          fill="currentColor"
                          d="M13.415.001C6.07 5.185.887 13.681.887 23.041c0 7.632 4.608 12.096 9.936 12.096 5.04 0 8.784-4.032 8.784-8.784 0-4.752-3.312-8.208-7.632-8.208-.864 0-2.016.144-2.304.288.72-4.896 5.328-10.656 9.936-13.536L13.415.001zm24.768 0c-7.2 5.184-12.384 13.68-12.384 23.04 0 7.632 4.608 12.096 9.936 12.096 4.896 0 8.784-4.032 8.784-8.784 0-4.752-3.456-8.208-7.776-8.208-.864 0-1.872.144-2.16.288.72-4.896 5.184-10.656 9.792-13.536L38.183.001z"
                        />
                      </svg>
                    </div>
                    <p className="text-gray-700 italic mb-6">
                      "{testimonial.content}"
                    </p>
                  </div>
                  
                  <Separator className="my-4" />
                  
                  <div className="flex items-center">
                    <div className="h-12 w-12 rounded-full overflow-hidden mr-4 flex-shrink-0">
                      <img
                        src={testimonial.image}
                        alt={testimonial.name}
                        className="h-full w-full object-cover"
                      />
                    </div>
                    <div>
                      <p className="font-semibold text-brand-blue">{testimonial.name}</p>
                      <p className="text-sm text-gray-500">{testimonial.role}</p>
                    </div>
                  </div>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    </section>
  );
};

export default TestimonialsSection;
